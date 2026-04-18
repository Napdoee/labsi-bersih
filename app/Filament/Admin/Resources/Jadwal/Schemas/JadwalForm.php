<?php

namespace App\Filament\Admin\Resources\Jadwal\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class JadwalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_matkul')
                    ->label('Mata Kuliah')
                    ->relationship('mataKuliah', 'nama_matkul')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('id_ruangan')
                    ->label('Ruangan')
                    ->relationship('ruangan', 'nama_ruangan')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('id_kelas')
                    ->label('Kelas')
                    ->relationship('kelas', 'nama_kelas')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('hari')
                    ->label('Hari')
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                    ])
                    ->required(),
                TimePicker::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->required(),
                TimePicker::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->required(),
            ]);
    }
}
