<?php

namespace App\Filament\Admin\Resources\LaporanBarangRusaks\Pages;

use App\Filament\Admin\Resources\LaporanBarangRusaks\LaporanBarangRusakResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaporanBarangRusaks extends ListRecords
{
    protected static string $resource = LaporanBarangRusakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
