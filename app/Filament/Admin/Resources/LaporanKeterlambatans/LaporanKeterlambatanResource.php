<?php

namespace App\Filament\Admin\Resources\LaporanKeterlambatans;

use App\Filament\Admin\Resources\LaporanKeterlambatans\Pages\CreateLaporanKeterlambatan;
use App\Filament\Admin\Resources\LaporanKeterlambatans\Pages\EditLaporanKeterlambatan;
use App\Filament\Admin\Resources\LaporanKeterlambatans\Pages\ListLaporanKeterlambatans;
use App\Filament\Admin\Resources\LaporanKeterlambatans\Pages\ViewLaporanKeterlambatan;
use App\Filament\Admin\Resources\LaporanKeterlambatans\Schemas\LaporanKeterlambatanForm;
use App\Filament\Admin\Resources\LaporanKeterlambatans\Schemas\LaporanKeterlambatanInfolist;
use App\Filament\Admin\Resources\LaporanKeterlambatans\Tables\LaporanKeterlambatansTable;
use App\Models\LaporanKeterlambatan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaporanKeterlambatanResource extends Resource
{
    protected static ?string $model = LaporanKeterlambatan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LaporanKeterlambatanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LaporanKeterlambatanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanKeterlambatansTable::configure($table);
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
            'index' => ListLaporanKeterlambatans::route('/'),
            'create' => CreateLaporanKeterlambatan::route('/create'),
            'view' => ViewLaporanKeterlambatan::route('/{record}'),
            'edit' => EditLaporanKeterlambatan::route('/{record}/edit'),
        ];
    }
}
