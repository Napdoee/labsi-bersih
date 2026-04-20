<?php

namespace App\Filament\Admin\Resources\LaporanSampah\Pages;

use App\Filament\Admin\Resources\LaporanSampah\LaporanSampahResource;
use Filament\Resources\Pages\ViewRecord;

class ViewLaporanSampah extends ViewRecord
{
    protected static string $resource = LaporanSampahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
