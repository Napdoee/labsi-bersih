<?php

namespace App\Filament\Admin\Resources\LaporanKeterlambatans\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;

class LaporanKeterlambatanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('waktu_lapor')->dateTime('d M Y, H:i'),
                TextEntry::make('kelas.nama_kelas')->label('Kelas'),
                TextEntry::make('asisten.nama_asisten')->label('Asisten'),
                TextEntry::make('jadwal.mataKuliah.nama_matkul')->label('Mata Kuliah'),
                TextEntry::make('keterlambatan')->suffix(' Menit'),
                TextEntry::make('deskripsi')->label('Keterangan Lengkap'),
            ]);
    }
}
