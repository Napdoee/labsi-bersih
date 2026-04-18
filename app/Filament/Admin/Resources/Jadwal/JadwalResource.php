<?php

namespace App\Filament\Admin\Resources\Jadwal;

use App\Filament\Admin\Resources\Jadwal\Pages\CreateJadwal;
use App\Filament\Admin\Resources\Jadwal\Pages\EditJadwal;
use App\Filament\Admin\Resources\Jadwal\Pages\ListJadwal;
use App\Filament\Admin\Resources\Jadwal\Schemas\JadwalForm;
use App\Filament\Admin\Resources\Jadwal\Tables\JadwalTable;
use App\Models\Jadwal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JadwalResource extends Resource
{
    protected static ?string $model = Jadwal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Jadwal';

    protected static ?string $modelLabel = 'Jadwal';

    protected static ?string $pluralModelLabel = 'Jadwal';

    protected static UnitEnum|string|null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return JadwalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JadwalTable::configure($table);
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
            'index' => ListJadwal::route('/'),
            'create' => CreateJadwal::route('/create'),
            'edit' => EditJadwal::route('/{record}/edit'),
        ];
    }
}
