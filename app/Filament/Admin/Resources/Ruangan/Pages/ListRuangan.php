<?php

namespace App\Filament\Admin\Resources\Ruangan\Pages;

use App\Filament\Admin\Resources\Ruangan\RuanganResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRuangan extends ListRecords
{
    protected static string $resource = RuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
