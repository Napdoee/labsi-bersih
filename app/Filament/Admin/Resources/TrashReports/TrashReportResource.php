<?php

namespace App\Filament\Admin\Resources\TrashReports;

use App\Filament\Admin\Resources\TrashReports\Pages\CreateTrashReport;
use App\Filament\Admin\Resources\TrashReports\Pages\EditTrashReport;
use App\Filament\Admin\Resources\TrashReports\Pages\ListTrashReports;
use App\Filament\Admin\Resources\TrashReports\Pages\ViewTrashReport;
use App\Filament\Admin\Resources\TrashReports\Schemas\TrashReportForm;
use App\Filament\Admin\Resources\TrashReports\Schemas\TrashReportInfolist;
use App\Filament\Admin\Resources\TrashReports\Tables\TrashReportsTable;
use App\Models\TrashReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TrashReportResource extends Resource
{
    protected static ?string $model = TrashReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'room';

    public static function form(Schema $schema): Schema
    {
        return TrashReportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TrashReportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrashReportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTrashReports::route('/'),
            'create' => CreateTrashReport::route('/create'),
            'view' => ViewTrashReport::route('/{record}'),
            'edit' => EditTrashReport::route('/{record}/edit'),
        ];
    }

}
