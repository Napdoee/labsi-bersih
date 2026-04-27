<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\LaporanKeterlambatan;
use App\Models\LaporanBarangRusak;
use App\Models\LaporanSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAsisten = $user->hasRole('asisten');
        $isKetuaTingkat = $user->hasRole('ketua_tingkat');

        $jadwals = collect();
        $keterlambatans = collect();
        $reportsInRooms = collect(); // For asisten: broken items in their assigned rooms
        $totalPinalti = 0;

        if ($isAsisten) {
            $asisten = $user->asisten;
            if ($asisten) {
                // 1. Get jadwal where this asisten is assigned
                $jadwals = Jadwal::whereHas('asistens', function($query) use ($asisten) {
                    $query->where('asisten.id_asisten', $asisten->id_asisten);
                })->with(['mataKuliah', 'ruangan', 'kelas'])->get();

                // 2. Get keterlambatan reports ABOUT this asisten
                $keterlambatans = LaporanKeterlambatan::where('id_asisten', $asisten->id_asisten)
                    ->with(['mataKuliah', 'kelas'])
                    ->latest('waktu_lapor')
                    ->get();
                
                // Pinalti Accumulation (sum of minutes)
                $totalPinalti = $keterlambatans->sum('keterlambatan');

                // 3. Get Laporan Barang Rusak in rooms where this asisten has classes
                $roomIds = $jadwals->pluck('id_ruangan')->unique();
                $reportsInRooms = LaporanBarangRusak::whereIn('id_ruangan', $roomIds)
                    ->where('status_laporan', '!=', 'Selesai')
                    ->with(['ruangan'])
                    ->latest('waktu_lapor')
                    ->get();
            }
        } elseif ($isKetuaTingkat) {
            $kelas = $user->kelas;
            if ($kelas) {
                // Get jadwal for this class
                $jadwals = Jadwal::where('id_kelas', $kelas->id_kelas)
                    ->with(['mataKuliah', 'ruangan'])
                    ->get();

                // Get keterlambatan reports for this class
                $keterlambatans = LaporanKeterlambatan::where('id_kelas', $kelas->id_kelas)
                    ->with(['mataKuliah', 'asisten'])
                    ->latest('waktu_lapor')
                    ->get();
                
                // Get trash reports where this class is penalized
                $sampahReports = LaporanSampah::where('id_kelas_pinalti', $kelas->id_kelas)
                    ->with(['ruangan'])
                    ->latest('waktu_lapor')
                    ->get();
                
                $totalPinalti = $keterlambatans->count() + $sampahReports->count();
            }
        }

        return view('dashboard', [
            'jadwals' => $jadwals,
            'keterlambatans' => $keterlambatans,
            'sampahReports' => $sampahReports ?? collect(),
            'reportsInRooms' => $reportsInRooms,
            'totalPinalti' => $totalPinalti,
            'isAsisten' => $isAsisten,
            'isKetuaTingkat' => $isKetuaTingkat
        ]);
    }
}
