<?php

namespace App\Filament\Admin\Resources\TrashReports\Pages;

use App\Filament\Admin\Resources\TrashReports\TrashReportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTrashReport extends ViewRecord
{
    protected static string $resource = TrashReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
