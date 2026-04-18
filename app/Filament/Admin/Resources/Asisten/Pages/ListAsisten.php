<?php

namespace App\Filament\Admin\Resources\Asisten\Pages;

use App\Filament\Admin\Resources\Asisten\AsistenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAsisten extends ListRecords
{
    protected static string $resource = AsistenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
