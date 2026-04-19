<?php

namespace App\Filament\Admin\Resources\LaporanBarangRusaks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class LaporanBarangRusakForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_ruangan')
                    ->relationship('ruangan', 'nama_ruangan')
                    ->label('Ruangan')
                    ->disabled()
                    ->required(),
                Select::make('id_user')
                    ->relationship('user', 'username')
                    ->label('Pelapor')
                    ->disabled()
                    ->required(),
                TextInput::make('nama_barang')
                    ->label('Nama Barang')
                    ->disabled()
                    ->required(),
                TextInput::make('no_meja_pc')
                    ->label('Nomor Meja/PC')
                    ->disabled(),
                Textarea::make('deskripsi_kerusakan')
                    ->label('Deskripsi Kerusakan')
                    ->disabled()
                    ->columnSpanFull()
                    ->required(),
                FileUpload::make('foto_bukti')
                    ->label('Foto Bukti')
                    ->disk('public')
                    ->directory('laporan-barang-rusak')
                    ->disabled()
                    ->columnSpanFull()
                    ->required(),
                Select::make('status_laporan')
                    ->label('Status Laporan')
                    ->options([
                        'Pending' => 'Pending',
                        'Sedang Diperbaiki' => 'Sedang Diperbaiki',
                        'Selesai' => 'Selesai',
                    ])
                    ->required()
                    ->default('Pending'),
                DateTimePicker::make('waktu_lapor')
                    ->label('Waktu Lapor')
                    ->disabled()
                    ->required(),
            ]);
    }
}
