<?php

namespace App\Filament\Admin\Resources\LaporanBarangRusaks\Pages;

use App\Filament\Admin\Resources\LaporanBarangRusaks\LaporanBarangRusakResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanBarangRusak extends EditRecord
{
    protected static string $resource = LaporanBarangRusakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
