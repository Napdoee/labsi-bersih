<?php

namespace App\Filament\Admin\Resources\Asisten\Pages;

use App\Filament\Admin\Resources\Asisten\AsistenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAsisten extends EditRecord
{
    protected static string $resource = AsistenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
