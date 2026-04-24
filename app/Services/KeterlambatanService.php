<?php

namespace App\Services;

use App\Models\Jadwal;
use App\Models\LaporanKeterlambatan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class KeterlambatanService
{
    /**
     * Mendapatkan daftar jadwal aktif untuk kelas tertentu pada hari ini.
     */
    public function getJadwalAktifHariIni(int $idKelas): Collection
    {
        Carbon::setLocale('id');
        $hariIni = Carbon::now()->translatedFormat('l');

        return Jadwal::with(['mataKuliah', 'ruangan', 'asistens'])
            ->where('id_kelas', $idKelas)
            ->where('hari', $hariIni)
            ->get();
    }



    /**
     * Mengecek apakah asisten sudah dilaporkan hari ini.
     */
    public function sudahDilaporHariIni(int $idAsisten): bool
    {
        return LaporanKeterlambatan::where('id_asisten', $idAsisten)
            ->whereDate('waktu_lapor', Carbon::today())
            ->exists();
    }

    /**
     * Menyimpan data laporan keterlambatan ke database.
     */
    public function simpanLaporan(array $data): LaporanKeterlambatan
    {
        $jadwal = Jadwal::findOrFail($data['id_jadwal']);
        
        // Sekarang input 'waktu_masuk_aktual' berisi angka menit keterlambatan
        $menitTerlambat = (int) $data['waktu_masuk_aktual'];

        return LaporanKeterlambatan::create([
            'id_matkul'     => $jadwal->id_matkul,
            'id_asisten'    => $data['id_asisten'],
            'id_kelas'      => $jadwal->id_kelas,
            'id_jadwal'     => $data['id_jadwal'],
            'id_user'       => $data['id_user'],
            'keterlambatan' => $menitTerlambat,
            'deskripsi'     => $data['deskripsi'] ?? null,
        ]);
    }
}