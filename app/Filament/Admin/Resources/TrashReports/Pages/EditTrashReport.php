<?php

namespace App\Filament\Admin\Resources\TrashReports\Pages;

use App\Filament\Admin\Resources\TrashReports\TrashReportResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTrashReport extends EditRecord
{
    protected static string $resource = TrashReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
