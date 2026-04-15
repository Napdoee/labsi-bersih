<?php

namespace App\Filament\Admin\Resources\TrashReports\Schemas;

use Filament\Schemas\Schema;
// GUNAKAN ALAMAT INI (SCHEMAS, BUKAN FORMS)
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class TrashReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Buat Laporan Sampah')
                ->description('Foto + Lokasi = laporan lebih cepat diproses')
                ->schema([
                    Select::make('room')
                        ->label('Lokasi')
                        ->options([
                            'Lab 401' => 'Lab 401',
                            'Lab 402' => 'Lab 402',
                            'Lab 403' => 'Lab 403',
                        ])
                        ->required(),
                    FileUpload::make('image')
                        ->label('Bukti Foto')
                        ->image()
                        ->extraInputAttributes(['capture' => 'camera'])
                        ->imageEditor()
                        ->directory('trash-reports')
                        ->required(),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->placeholder('Jelaskan apa yang terjadi....')
                        ->required()
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }
}