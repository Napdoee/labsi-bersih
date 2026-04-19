<?php

namespace App\Filament\Admin\Resources\LaporanBarangRusaks\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LaporanBarangRusakInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id_ruangan')
                    ->numeric(),
                TextEntry::make('id_user')
                    ->numeric(),
                TextEntry::make('nama_barang'),
                TextEntry::make('no_meja_pc')
                    ->placeholder('-'),
                TextEntry::make('deskripsi_kerusakan')
                    ->columnSpanFull(),
                TextEntry::make('status_laporan'),
                TextEntry::make('waktu_lapor')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                ImageEntry::make('foto_bukti')
                    ->label('Foto')
                    ->disk('public'),
                    // ->imageWidth(fn () => 100)
                    // ->imageHeight(fn () => 100),
            ]);
    }
}
