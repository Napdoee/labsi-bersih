<?php

namespace App\Services;

use App\Models\Jadwal;
use App\Models\LaporanSampah;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class LaporanSampahService
{
    /**
     * Mendapatkan daftar ruangan yang dijadwalkan untuk kelas ini hari ini.
     * Digunakan untuk dropdown "Pilih Ruangan/Lab".
     */
    public function getRuanganHariIni(int $idKelas): Collection
    {
        Carbon::setLocale('id');
        $hariIni = Carbon::now()->translatedFormat('l');

        return Jadwal::with(['mataKuliah', 'ruangan'])
            ->where('id_kelas', $idKelas)
            ->where('hari', $hariIni)
            ->get();
    }

    /**
     * Mendapatkan daftar ruangan yang dijadwalkan untuk asisten ini hari ini.
     */
    public function getRuanganAsistenHariIni(int $idAsisten): Collection
    {
        Carbon::setLocale('id');
        $hariIni = Carbon::now()->translatedFormat('l');

        return Jadwal::with(['mataKuliah', 'ruangan'])
            ->whereHas('asistens', function ($q) use ($idAsisten) {
                $q->where('detail_asisten.id_asisten', $idAsisten);
            })
            ->where('hari', $hariIni)
            ->get();
    }

    /**
     * Deteksi kelas yang menempati ruangan pada sesi SEBELUMNYA.
     *
     * Logika:
     * 1. Ambil jadwal pelapor (untuk mengetahui waktu_mulai sesi saat ini)
     * 2. Cari jadwal lain di ruangan yang sama, hari yang sama,
     *    yang waktu_selesai <= waktu_mulai pelapor (sesi sebelumnya)
     * 3. Kelas di sesi sebelumnya itulah yang kena pinalti.
     */
    public function detectKelasPinalti(int $idRuangan, ?int $idKelasPelapor, int $idUser): ?int
    {
        Carbon::setLocale('id');
        $hariIni = Carbon::now()->translatedFormat('l');

        $jadwalPelaporQuery = Jadwal::where('id_ruangan', $idRuangan)
            ->where('hari', $hariIni);

        if ($idKelasPelapor) {
            $jadwalPelaporQuery->where('id_kelas', $idKelasPelapor);
        } else {
            $user = \App\Models\User::find($idUser);
            if ($user && $user->asisten) {
                $idAsisten = $user->asisten->id_asisten;
                $jadwalPelaporQuery->whereHas('asistens', function ($q) use ($idAsisten) {
                    $q->where('detail_asisten.id_asisten', $idAsisten);
                });
            }
        }

        $jadwalPelapor = $jadwalPelaporQuery->orderBy('waktu_mulai', 'asc')->first();

        if (!$jadwalPelapor) {
            return null;
        }

        $jadwalSebelumnya = Jadwal::where('id_ruangan', $idRuangan)
            ->where('hari', $hariIni)
            ->when($idKelasPelapor, function($q) use ($idKelasPelapor) {
                $q->where('id_kelas', '!=', $idKelasPelapor);
            }, function($q) use ($jadwalPelapor) {
                // Jika pelapor adalah asisten, maka sesi yang dilaporkan adalah sesi kelas dari jadwal pelapor
                $q->where('id_kelas', '!=', $jadwalPelapor->id_kelas);
            })
            ->where('waktu_selesai', '<=', $jadwalPelapor->waktu_mulai)
            ->orderBy('waktu_selesai', 'desc') // ambil yang paling dekat
            ->first();

        return $jadwalSebelumnya?->id_kelas;
    }

    /**
     * Menyimpan laporan sampah dan otomatis menentukan pinalti.
     */
    public function simpanLaporan(array $data): LaporanSampah
    {
        $idKelasPelapor = $data['id_kelas_pelapor'];
        $idRuangan = $data['id_ruangan'];
        $idUser = $data['id_user'];

        // Auto-detect kelas pinalti
        $idKelasPinalti = $this->detectKelasPinalti($idRuangan, $idKelasPelapor, $idUser);

        return LaporanSampah::create([
            'id_ruangan'       => $idRuangan,
            'id_kelas_pelapor' => $idKelasPelapor,
            'id_kelas_pinalti' => $idKelasPinalti,
            'id_user'          => $data['id_user'],
            'foto_sampah'      => $data['foto_sampah'],
            'deskripsi'        => $data['deskripsi'] ?? null,
            'status'           => 'menunggu',
        ]);
    }
}
