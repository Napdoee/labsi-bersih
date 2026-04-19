<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LaporanBarangRusak;
use App\Services\LaporanSampahService; // using for getRuanganHariIni
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class LaporanBarangRusakController extends Controller
{
    protected LaporanSampahService $laporanSampahService;

    public function __construct(LaporanSampahService $laporanSampahService)
    {
        $this->laporanSampahService = $laporanSampahService;
    }

    public function index(): View
    {
        $laporan = LaporanBarangRusak::with(['ruangan', 'user'])
            ->where('id_user', Auth::id())
            ->latest('waktu_lapor')
            ->get();

        return view('kelas.barang_rusak.index', compact('laporan'));
    }

    public function create(): View
    {
        return view('kelas.barang_rusak.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id_ruangan'          => 'required|exists:ruangan,id_ruangan',
            'nama_barang'         => 'required|string|max:255',
            'no_meja_pc'          => 'nullable|string|max:255',
            'deskripsi_kerusakan' => 'required|string',
            'foto_bukti'          => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data['id_user'] = Auth::id();

        if ($request->hasFile('foto_bukti')) {
            $path = $request->file('foto_bukti')->store('laporan-barang-rusak', 'public');
            $data['foto_bukti'] = $path;
        }

        LaporanBarangRusak::create($data);

        return redirect()->route('kelas.barang-rusak.index')
            ->with('success', 'Laporan barang rusak berhasil dikirim.');
    }

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

        // Unique by id_ruangan just in case multiple schedules in same room
        $data = collect($data)->unique('id_ruangan')->values();

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }
}
