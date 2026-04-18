<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Asisten;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Ruangan;
use App\Models\Jadwal;
use App\Models\DetailAsisten;

class DatabaseImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ---------------------------------------------------
        // 1. SEEDING MASTER DATA (Tanpa Relasi)
        // ---------------------------------------------------
        
        $matkuls = [
            ['id_matkul' => 1, 'nama_matkul' => 'Praktikum Algoritma Pemrograman'],
            ['id_matkul' => 2, 'nama_matkul' => 'Praktikum Desain UI/UX'],
            ['id_matkul' => 3, 'nama_matkul' => 'Praktikum Data Warehouse dan BI'],
            ['id_matkul' => 4, 'nama_matkul' => 'Praktikum Keamanan Data & Informasi'],
            ['id_matkul' => 5, 'nama_matkul' => 'Praktikum Pemrograman WEB'],
            ['id_matkul' => 6, 'nama_matkul' => 'Praktikum Pemrograman Mobile'],
            ['id_matkul' => 7, 'nama_matkul' => 'Praktikum Software Testing dan Quality Assurance'],
        ];
        MataKuliah::upsert($matkuls, ['id_matkul'], ['nama_matkul']);

        $ruangans = [
            ['id_ruangan' => 1, 'nama_ruangan' => 'Lab 401'],
            ['id_ruangan' => 2, 'nama_ruangan' => 'Lab 402'],
            ['id_ruangan' => 3, 'nama_ruangan' => 'Lab 403'],
        ];
        Ruangan::upsert($ruangans, ['id_ruangan'], ['nama_ruangan']);

        // ---------------------------------------------------
        // 2. SEEDING DATA USER -> ASISTEN
        // ---------------------------------------------------
        $dataAsisten = [
            ['id_sql' => 1, 'nim' => '60900122039', 'nama_asisten' => 'MUH.IMRAN'],
            ['id_sql' => 2, 'nim' => '60900122002', 'nama_asisten' => 'Cahyana Ramadani.S'],
            ['id_sql' => 3, 'nim' => '60900122017', 'nama_asisten' => 'MUHAMMAD GILANG'],
            ['id_sql' => 4, 'nim' => '60900123025', 'nama_asisten' => 'AIDIL FITRA'],
            ['id_sql' => 5, 'nim' => '60900123042', 'nama_asisten' => 'MUH MAHIR IMAM B'],
            ['id_sql' => 6, 'nim' => '60900123017', 'nama_asisten' => 'NABILA ZALSABILA'],
            ['id_sql' => 7, 'nim' => '60900123012', 'nama_asisten' => 'MUHAMMAD ALFAUZAN BOBIHU'],
            ['id_sql' => 8, 'nim' => '60900123046', 'nama_asisten' => 'MUTHIA NUR FAIQA'],
            ['id_sql' => 9, 'nim' => '60900123001', 'nama_asisten' => 'AGUNG PRASASTI ABADI'],
            ['id_sql' => 10, 'nim' => '60900123011', 'nama_asisten' => 'SELFIRA'],
            ['id_sql' => 11, 'nim' => '60900123030', 'nama_asisten' => 'ZHAKA HIDAYAT YASIR'],
            ['id_sql' => 12, 'nim' => '60900123023', 'nama_asisten' => 'AGUNG SETYA'],
            ['id_sql' => 13, 'nim' => '60900123045', 'nama_asisten' => 'SAMSUARDI'],
            ['id_sql' => 14, 'nim' => '60900123002', 'nama_asisten' => 'ATIKA RESKI'],
            ['id_sql' => 15, 'nim' => '60900123022', 'nama_asisten' => 'ANDI MUHAMMAD SAID'],
            ['id_sql' => 16, 'nim' => '60900123028', 'nama_asisten' => 'ASADUL HAYYAN NASRULLAH'],
            ['id_sql' => 17, 'nim' => '60900123018', 'nama_asisten' => 'JUSMAWATI'],
            ['id_sql' => 18, 'nim' => '60900123031', 'nama_asisten' => 'Harahman Abd Arib'],
            ['id_sql' => 19, 'nim' => '60900123005', 'nama_asisten' => 'MUH. ANGGI RIFQIYADI'],
            ['id_sql' => 20, 'nim' => '60900123066', 'nama_asisten' => 'RASNAH'],
            ['id_sql' => 21, 'nim' => '60900123050', 'nama_asisten' => 'SITI AISYAH'],
            ['id_sql' => 22, 'nim' => '60900123009', 'nama_asisten' => 'HIKMA RAMADHANI'],
            ['id_sql' => 23, 'nim' => '60900124010', 'nama_asisten' => 'Muhammad Indar'],
            ['id_sql' => 24, 'nim' => '60900124018', 'nama_asisten' => 'Ahmad Miftah Hidayatullah'],
            ['id_sql' => 25, 'nim' => '60900124035', 'nama_asisten' => 'Hidayat Sula Idris'],
            ['id_sql' => 26, 'nim' => '60900124055', 'nama_asisten' => 'Ahmad Farel Nurfajri'],
        ];

        $mapIdAsisten = [];
        foreach ($dataAsisten as $data) {
            $user = User::firstOrCreate(
                ['username' => $data['nim']],
                [
                    'password' => Hash::make('Pass_' . substr($data['nim'], -5)), 
                ]
            );
            $user->assignRole('asisten');

            $asisten = Asisten::firstOrCreate(
                ['id_user' => $user->id],
                ['nama_asisten' => $data['nama_asisten']]
            );
            $mapIdAsisten[$data['id_sql']] = $asisten->id_asisten; 
        }

        // ---------------------------------------------------
        // 3. SEEDING DATA USER -> KELAS
        // ---------------------------------------------------
        $dataKelas = [
            ['id_sql' => 1, 'kode' => 'kelasA23', 'nama_kelas' => 'kelasA23'],
            ['id_sql' => 2, 'kode' => 'kelasB23', 'nama_kelas' => 'kelasB23'],
            ['id_sql' => 3, 'kode' => 'kelasC23', 'nama_kelas' => 'kelasC23'],
            ['id_sql' => 4, 'kode' => 'kelasA24', 'nama_kelas' => 'kelasA24'],
            ['id_sql' => 5, 'kode' => 'kelasB24', 'nama_kelas' => 'kelasB24'],
            ['id_sql' => 6, 'kode' => 'kelasC24', 'nama_kelas' => 'kelasC24'],
            ['id_sql' => 7, 'kode' => 'kelasD24', 'nama_kelas' => 'kelasD24'],
            ['id_sql' => 8, 'kode' => 'kelasE24', 'nama_kelas' => 'kelasE24'],
            ['id_sql' => 9, 'kode' => 'kelasA25', 'nama_kelas' => 'kelasA25'],
            ['id_sql' => 10, 'kode' => 'kelasB25', 'nama_kelas' => 'kelasB25'],
            ['id_sql' => 11, 'kode' => 'kelasC25', 'nama_kelas' => 'kelasC25'],
            ['id_sql' => 12, 'kode' => 'kelasD25', 'nama_kelas' => 'kelasD25'],
            ['id_sql' => 13, 'kode' => 'kelasE25', 'nama_kelas' => 'kelasE25'],
        ];

        $mapIdKelas = [];
        foreach ($dataKelas as $data) {
            $user = User::firstOrCreate(
                ['username' => $data['kode']], 
                [
                    'password' => Hash::make('Pass_' . str_replace('kelas', '', $data['kode'])),
                ]
            );
            $user->assignRole('ketua_tingkat'); 

            $kelas = Kelas::firstOrCreate(
                ['id_user' => $user->id],
                ['nama_kelas' => $data['nama_kelas']]
            );
            $mapIdKelas[$data['id_sql']] = $kelas->id_kelas;
        }

        // ---------------------------------------------------
        // 4. SEEDING JADWAL (Tabel Transaksional Master)
        // ---------------------------------------------------
        $dataJadwal = [
            ['id_sql' => 1, 'id_matkul' => 1, 'id_ruangan' => 2, 'id_kelas_sql' => 10, 'hari' => 'Rabu', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 2, 'id_matkul' => 1, 'id_ruangan' => 2, 'id_kelas_sql' => 12, 'hari' => 'Selasa', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 3, 'id_matkul' => 1, 'id_ruangan' => 2, 'id_kelas_sql' => 9,  'hari' => 'Senin', 'waktu_mulai' => '09:50:00', 'waktu_selesai' => '11:30:00'],
            ['id_sql' => 4, 'id_matkul' => 1, 'id_ruangan' => 2, 'id_kelas_sql' => 11, 'hari' => 'Kamis', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 5, 'id_matkul' => 1, 'id_ruangan' => 2, 'id_kelas_sql' => 13, 'hari' => 'Jumat', 'waktu_mulai' => '09:50:00', 'waktu_selesai' => '11:30:00'],
            ['id_sql' => 6, 'id_matkul' => 2, 'id_ruangan' => 2, 'id_kelas_sql' => 4,  'hari' => 'Jumat', 'waktu_mulai' => '15:25:00', 'waktu_selesai' => '17:05:00'],
            ['id_sql' => 7, 'id_matkul' => 2, 'id_ruangan' => 1, 'id_kelas_sql' => 5,  'hari' => 'Jumat', 'waktu_mulai' => '09:50:00', 'waktu_selesai' => '11:30:00'],
            ['id_sql' => 8, 'id_matkul' => 2, 'id_ruangan' => 2, 'id_kelas_sql' => 6,  'hari' => 'Kamis', 'waktu_mulai' => '09:50:00', 'waktu_selesai' => '11:30:00'],
            ['id_sql' => 9, 'id_matkul' => 2, 'id_ruangan' => 2, 'id_kelas_sql' => 7,  'hari' => 'Senin', 'waktu_mulai' => '15:25:00', 'waktu_selesai' => '17:05:00'],
            ['id_sql' => 10, 'id_matkul' => 2, 'id_ruangan' => 2, 'id_kelas_sql' => 8, 'hari' => 'Rabu', 'waktu_mulai' => '12:50:00', 'waktu_selesai' => '15:20:00'],
            ['id_sql' => 11, 'id_matkul' => 3, 'id_ruangan' => 3, 'id_kelas_sql' => 4, 'hari' => 'Jumat', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 12, 'id_matkul' => 3, 'id_ruangan' => 3, 'id_kelas_sql' => 5, 'hari' => 'Senin', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 13, 'id_matkul' => 3, 'id_ruangan' => 3, 'id_kelas_sql' => 6, 'hari' => 'Senin', 'waktu_mulai' => '09:50:00', 'waktu_selesai' => '11:30:00'],
            ['id_sql' => 14, 'id_matkul' => 3, 'id_ruangan' => 1, 'id_kelas_sql' => 7, 'hari' => 'Rabu', 'waktu_mulai' => '09:50:00', 'waktu_selesai' => '11:30:00'],
            ['id_sql' => 15, 'id_matkul' => 3, 'id_ruangan' => 3, 'id_kelas_sql' => 8, 'hari' => 'Selasa', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 16, 'id_matkul' => 4, 'id_ruangan' => 1, 'id_kelas_sql' => 4, 'hari' => 'Selasa', 'waktu_mulai' => '15:25:00', 'waktu_selesai' => '17:05:00'],
            ['id_sql' => 17, 'id_matkul' => 4, 'id_ruangan' => 2, 'id_kelas_sql' => 5, 'hari' => 'Rabu', 'waktu_mulai' => '15:25:00', 'waktu_selesai' => '17:05:00'],
            ['id_sql' => 18, 'id_matkul' => 4, 'id_ruangan' => 1, 'id_kelas_sql' => 6, 'hari' => 'Jumat', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 19, 'id_matkul' => 4, 'id_ruangan' => 1, 'id_kelas_sql' => 7, 'hari' => 'Kamis', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 20, 'id_matkul' => 4, 'id_ruangan' => 3, 'id_kelas_sql' => 8, 'hari' => 'Rabu', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 21, 'id_matkul' => 5, 'id_ruangan' => 2, 'id_kelas_sql' => 4, 'hari' => 'Jumat', 'waktu_mulai' => '13:10:00', 'waktu_selesai' => '15:20:00'],
            ['id_sql' => 22, 'id_matkul' => 5, 'id_ruangan' => 3, 'id_kelas_sql' => 5, 'hari' => 'Rabu', 'waktu_mulai' => '12:50:00', 'waktu_selesai' => '15:20:00'],
            ['id_sql' => 23, 'id_matkul' => 5, 'id_ruangan' => 3, 'id_kelas_sql' => 6, 'hari' => 'Rabu', 'waktu_mulai' => '09:50:00', 'waktu_selesai' => '11:30:00'],
            ['id_sql' => 24, 'id_matkul' => 5, 'id_ruangan' => 1, 'id_kelas_sql' => 7, 'hari' => 'Rabu', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'],
            ['id_sql' => 25, 'id_matkul' => 5, 'id_ruangan' => 1, 'id_kelas_sql' => 8, 'hari' => 'Jumat', 'waktu_mulai' => '13:10:00', 'waktu_selesai' => '15:20:00'],
            ['id_sql' => 26, 'id_matkul' => 6, 'id_ruangan' => 3, 'id_kelas_sql' => 1, 'hari' => 'Rabu', 'waktu_mulai' => '15:25:00', 'waktu_selesai' => '17:05:00'],
            ['id_sql' => 27, 'id_matkul' => 7, 'id_ruangan' => 3, 'id_kelas_sql' => 1, 'hari' => 'Senin', 'waktu_mulai' => '12:50:00', 'waktu_selesai' => '15:20:00'],
            ['id_sql' => 28, 'id_matkul' => 7, 'id_ruangan' => 3, 'id_kelas_sql' => 2, 'hari' => 'Senin', 'waktu_mulai' => '15:25:00', 'waktu_selesai' => '17:05:00'],
            ['id_sql' => 29, 'id_matkul' => 7, 'id_ruangan' => 1, 'id_kelas_sql' => 3, 'hari' => 'Rabu', 'waktu_mulai' => '15:25:00', 'waktu_selesai' => '17:05:00'],
        ];

        $mapIdJadwal = [];
        foreach ($dataJadwal as $jadwalData) {
            if (!isset($mapIdKelas[$jadwalData['id_kelas_sql']])) continue;

            $jadwalBaru = Jadwal::firstOrCreate([
                'id_matkul'     => $jadwalData['id_matkul'],
                'id_ruangan'    => $jadwalData['id_ruangan'],
                'id_kelas'      => $mapIdKelas[$jadwalData['id_kelas_sql']],
                'hari'          => $jadwalData['hari'],
                'waktu_mulai'   => $jadwalData['waktu_mulai'],
                'waktu_selesai' => $jadwalData['waktu_selesai'],
            ]);
            $mapIdJadwal[$jadwalData['id_sql']] = $jadwalBaru->id_jadwal ?? $jadwalBaru->id;
        }

        // ---------------------------------------------------
        // 5. SEEDING DETAIL ASISTEN (Pivot)
        // ---------------------------------------------------
        $dataPivot = [
            ['id_asisten_sql' => 11, 'id_jadwal_sql' => 3], ['id_asisten_sql' => 18, 'id_jadwal_sql' => 3], ['id_asisten_sql' => 24, 'id_jadwal_sql' => 3],
            ['id_asisten_sql' => 13, 'id_jadwal_sql' => 1], ['id_asisten_sql' => 18, 'id_jadwal_sql' => 1], ['id_asisten_sql' => 25, 'id_jadwal_sql' => 1],
            ['id_asisten_sql' => 18, 'id_jadwal_sql' => 4], ['id_asisten_sql' => 11, 'id_jadwal_sql' => 4], ['id_asisten_sql' => 23, 'id_jadwal_sql' => 4],
            ['id_asisten_sql' => 10, 'id_jadwal_sql' => 2], ['id_asisten_sql' => 26, 'id_jadwal_sql' => 2], ['id_asisten_sql' => 25, 'id_jadwal_sql' => 2],
            ['id_asisten_sql' => 10, 'id_jadwal_sql' => 5], ['id_asisten_sql' => 23, 'id_jadwal_sql' => 5], ['id_asisten_sql' => 24, 'id_jadwal_sql' => 5],
            ['id_asisten_sql' => 15, 'id_jadwal_sql' => 6], ['id_asisten_sql' => 20, 'id_jadwal_sql' => 6],
            ['id_asisten_sql' => 4,  'id_jadwal_sql' => 7], ['id_asisten_sql' => 20, 'id_jadwal_sql' => 7],
            ['id_asisten_sql' => 15, 'id_jadwal_sql' => 8], ['id_asisten_sql' => 19, 'id_jadwal_sql' => 8],
            ['id_asisten_sql' => 19, 'id_jadwal_sql' => 9], ['id_asisten_sql' => 6,  'id_jadwal_sql' => 9],
            ['id_asisten_sql' => 8,  'id_jadwal_sql' => 10], ['id_asisten_sql' => 4,  'id_jadwal_sql' => 10],
            ['id_asisten_sql' => 9,  'id_jadwal_sql' => 11], ['id_asisten_sql' => 4,  'id_jadwal_sql' => 11],
            ['id_asisten_sql' => 4,  'id_jadwal_sql' => 12], ['id_asisten_sql' => 12, 'id_jadwal_sql' => 12],
            ['id_asisten_sql' => 21, 'id_jadwal_sql' => 13], ['id_asisten_sql' => 5,  'id_jadwal_sql' => 13],
            ['id_asisten_sql' => 5,  'id_jadwal_sql' => 14], ['id_asisten_sql' => 6,  'id_jadwal_sql' => 14],
            ['id_asisten_sql' => 7,  'id_jadwal_sql' => 15], ['id_asisten_sql' => 6,  'id_jadwal_sql' => 15],
            ['id_asisten_sql' => 7,  'id_jadwal_sql' => 16], ['id_asisten_sql' => 9,  'id_jadwal_sql' => 16],
            ['id_asisten_sql' => 7,  'id_jadwal_sql' => 17], ['id_asisten_sql' => 18, 'id_jadwal_sql' => 17],
            ['id_asisten_sql' => 18, 'id_jadwal_sql' => 18], ['id_asisten_sql' => 16, 'id_jadwal_sql' => 18],
            ['id_asisten_sql' => 17, 'id_jadwal_sql' => 19], ['id_asisten_sql' => 7,  'id_jadwal_sql' => 19],
            ['id_asisten_sql' => 5,  'id_jadwal_sql' => 20], ['id_asisten_sql' => 17, 'id_jadwal_sql' => 20],
            ['id_asisten_sql' => 16, 'id_jadwal_sql' => 21], ['id_asisten_sql' => 14, 'id_jadwal_sql' => 21],
            ['id_asisten_sql' => 13, 'id_jadwal_sql' => 22], ['id_asisten_sql' => 11, 'id_jadwal_sql' => 22],
            ['id_asisten_sql' => 11, 'id_jadwal_sql' => 23], ['id_asisten_sql' => 13, 'id_jadwal_sql' => 23],
            ['id_asisten_sql' => 12, 'id_jadwal_sql' => 24], ['id_asisten_sql' => 14, 'id_jadwal_sql' => 24],
            ['id_asisten_sql' => 12, 'id_jadwal_sql' => 25], ['id_asisten_sql' => 22, 'id_jadwal_sql' => 25],
            ['id_asisten_sql' => 1,  'id_jadwal_sql' => 26],
            ['id_asisten_sql' => 2,  'id_jadwal_sql' => 27], ['id_asisten_sql' => 3,  'id_jadwal_sql' => 27],
            ['id_asisten_sql' => 3,  'id_jadwal_sql' => 28], ['id_asisten_sql' => 2,  'id_jadwal_sql' => 28],
            ['id_asisten_sql' => 3,  'id_jadwal_sql' => 29], ['id_asisten_sql' => 2,  'id_jadwal_sql' => 29],
        ];

        foreach ($dataPivot as $pivot) {
            if (isset($mapIdAsisten[$pivot['id_asisten_sql']]) && isset($mapIdJadwal[$pivot['id_jadwal_sql']])) {
                DetailAsisten::firstOrCreate([
                    'id_asisten' => $mapIdAsisten[$pivot['id_asisten_sql']],
                    'id_jadwal'  => $mapIdJadwal[$pivot['id_jadwal_sql']],
                ]);
            }
        }
    }
}
