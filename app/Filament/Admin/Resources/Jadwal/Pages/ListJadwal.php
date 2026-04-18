<?php

namespace App\Filament\Admin\Resources\Jadwal\Pages;

use App\Filament\Admin\Resources\Jadwal\JadwalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJadwal extends ListRecords
{
    protected static string $resource = JadwalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
