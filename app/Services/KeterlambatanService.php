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
     * Menghitung keterlambatan dalam menit. pakai carbon dinda
     */
    public function hitungKeterlambatan(Jadwal $jadwal, string $waktuMasukAktual): int
    {
        $seharusnya = Carbon::parse($jadwal->waktu_mulai);
        $aktual = Carbon::parse($waktuMasukAktual);

        // false → tetap negatif jika datang lebih awal (aktual < seharusnya)
        $selisihMenit = $seharusnya->diffInMinutes($aktual, false);

        // Jika tidak terlambat kembalikan 0. Jika terlambat kembalikan menitnya dinda.
        return max(0, (int) $selisihMenit);
    }

    /**
     * Menyimpan data laporan keterlambatan ke database.
     */
    public function simpanLaporan(array $data): LaporanKeterlambatan
    {
        $jadwal = Jadwal::findOrFail($data['id_jadwal']);
        $menitTerlambat = $this->hitungKeterlambatan($jadwal, $data['waktu_masuk_aktual']);

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