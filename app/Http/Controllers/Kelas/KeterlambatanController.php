<?php

namespace App\Http\Controllers\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\StoreKeterlambatanRequest;
use App\Models\Jadwal;
use App\Models\LaporanKeterlambatan;
use App\Services\KeterlambatanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class KeterlambatanController extends Controller
{
    protected KeterlambatanService $keterlambatanService;

    public function __construct(KeterlambatanService $keterlambatanService)
    {
        $this->keterlambatanService = $keterlambatanService;
    }

    public function index(): View
    {
        $idKelas = Auth::user()->kelas->id_kelas ?? null; 

        // Ambil riwayat laporan
        $laporan = LaporanKeterlambatan::with(['jadwal.mataKuliah', 'asisten'])
            ->where('id_kelas', $idKelas)
            ->latest('waktu_lapor')
            ->get();

        return view('kelas.keterlambatan.index', compact('laporan'));
    }

    public function create(): View
    {
        return view('kelas.keterlambatan.create');
    }

    public function store(StoreKeterlambatanRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['id_user'] = Auth::id();

        $this->keterlambatanService->simpanLaporan($data);

        return redirect()->route('kelas.keterlambatan.index')
            ->with('success', 'Laporan keterlambatan berhasil disimpan.');
    }

    //endpoint AJAX dinda
    public function jadwalHariIni(): JsonResponse
    {
        $idKelas = Auth::user()->kelas->id_kelas ?? null;
        
        if (!$idKelas) {
            return response()->json(['success' => false, 'message' => 'Data Kelas tidak ditemukan.'], 404);
        }

        // mendapatkan jadwal
        $jadwal = $this->keterlambatanService->getJadwalAktifHariIni($idKelas);
        //format data respon
        $data = $jadwal->map(function ($j) {
            return [
                'id_jadwal'     => $j->id_jadwal,
                'nama_matkul'   => $j->mataKuliah->nama_matkul ?? 'Tidak diketahui',
                'nama_ruangan'  => $j->ruangan->nama_ruangan ?? 'Tidak diketahui',
                'waktu_mulai'   => $j->waktu_mulai,
                'waktu_selesai' => $j->waktu_selesai,
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }

    public function asisten($idJadwal): JsonResponse
    {
        // Cari jadwal beserta asisten
        $jadwal = Jadwal::with('asistens')->find($idJadwal);

        if (!$jadwal) {
            return response()->json(['success' => false, 'message' => 'Jadwal tidak ditemukan.'], 404);
        }

        $data = $jadwal->asistens->map(function ($asisten) {
            return [
                'id_asisten'   => $asisten->id_asisten,
                'nama_asisten' => $asisten->nama_asisten,
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }
}