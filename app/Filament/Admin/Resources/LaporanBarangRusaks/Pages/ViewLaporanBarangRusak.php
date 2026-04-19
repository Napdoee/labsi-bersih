<?php

namespace App\Filament\Admin\Resources\LaporanBarangRusaks\Pages;

use App\Filament\Admin\Resources\LaporanBarangRusaks\LaporanBarangRusakResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLaporanBarangRusak extends ViewRecord
{
    protected static string $resource = LaporanBarangRusakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
