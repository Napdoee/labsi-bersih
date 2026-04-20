<?php

namespace App\Http\Controllers\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\StoreLaporanSampahRequest;
use App\Models\LaporanSampah;
use App\Services\LaporanSampahService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class LaporanSampahController extends Controller
{
    protected LaporanSampahService $laporanSampahService;

    public function __construct(LaporanSampahService $laporanSampahService)
    {
        $this->laporanSampahService = $laporanSampahService;
    }

    /**
     * Tampilkan riwayat laporan sampah milik kelas.
     */
    public function index(): View
    {
        $laporan = LaporanSampah::with(['ruangan', 'kelasPelapor', 'kelasPinalti'])
            ->where('id_user', Auth::id())
            ->latest('waktu_lapor')
            ->get();

        return view('kelas.sampah.index', compact('laporan'));
    }

    /**
     * Tampilkan form buat laporan sampah.
     */
    public function create(): View
    {
        return view('kelas.sampah.create');
    }

    /**
     * Simpan laporan sampah baru.
     */
    public function store(StoreLaporanSampahRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['id_user'] = Auth::id();
        $data['id_kelas_pelapor'] = Auth::user()->kelas->id_kelas ?? null;

        // Upload foto
        if ($request->hasFile('foto_sampah')) {
            $path = $request->file('foto_sampah')->store('laporan-sampah', 'public');
            $data['foto_sampah'] = $path;
        }

        $laporan = $this->laporanSampahService->simpanLaporan($data);

        $message = 'Laporan sampah berhasil dikirim.';
        if ($laporan->id_kelas_pinalti) {
            $namaKelasPinalti = $laporan->kelasPinalti->nama_kelas ?? 'Tidak diketahui';
            $message .= " Pinalti otomatis ditetapkan kepada: {$namaKelasPinalti}.";
        } else {
            $message .= ' Tidak ditemukan kelas di sesi sebelumnya untuk pinalti.';
        }

        return redirect()->route('kelas.sampah.index')
            ->with('success', $message);
    }

    /**
     * Endpoint AJAX: Ambil daftar ruangan berdasarkan jadwal hari ini.
     */
    public function ruanganHariIni(): JsonResponse
    {
        $user = Auth::user();
        
        if ($user->hasRole('asisten')) {
            $idAsisten = $user->asisten->id_asisten ?? null;
            if (!$idAsisten) {
                return response()->json(['success' => false, 'message' => 'Data Asisten tidak ditemukan.'], 404);
            }
            $jadwal = $this->laporanSampahService->getRuanganAsistenHariIni($idAsisten);
        } else {
            $idKelas = $user->kelas->id_kelas ?? null;
            if (!$idKelas) {
                return response()->json(['success' => false, 'message' => 'Data Kelas tidak ditemukan.'], 404);
            }
            $jadwal = $this->laporanSampahService->getRuanganHariIni($idKelas);
        }

        $data = $jadwal->map(function ($j) {
            return [
                'id_ruangan'    => $j->ruangan->id_ruangan,
                'nama_ruangan'  => $j->ruangan->nama_ruangan ?? 'Tidak diketahui',
                'nama_matkul'   => $j->mataKuliah->nama_matkul ?? 'Tidak diketahui',
                'waktu_mulai'   => $j->waktu_mulai,
                'waktu_selesai' => $j->waktu_selesai,
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }
}
