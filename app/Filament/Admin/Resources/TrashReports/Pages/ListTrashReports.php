<?php

namespace App\Filament\Admin\Resources\TrashReports\Pages;

use App\Filament\Admin\Resources\TrashReports\TrashReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrashReports extends ListRecords
{
    protected static string $resource = TrashReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
