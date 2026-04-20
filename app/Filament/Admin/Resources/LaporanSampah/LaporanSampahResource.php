<?php

namespace App\Filament\Admin\Resources\LaporanSampah;

use App\Models\LaporanSampah;
use App\Filament\Admin\Resources\LaporanSampah\Pages\ListLaporanSampah;
use App\Filament\Admin\Resources\LaporanSampah\Pages\ViewLaporanSampah;
use App\Filament\Admin\Resources\LaporanSampah\Tables\LaporanSampahTable;
use App\Filament\Admin\Resources\LaporanSampah\Schemas\LaporanSampahInfolist;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaporanSampahResource extends Resource
{
    protected static ?string $model = LaporanSampah::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTrash;

    protected static ?string $navigationLabel = 'Laporan Sampah';

    protected static ?string $modelLabel = 'Laporan Sampah';

    protected static ?string $pluralModelLabel = 'Laporan Sampah';

    protected static ?int $navigationSort = 2;

    public static function infolist(Schema $schema): Schema
    {
        return LaporanSampahInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanSampahTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaporanSampah::route('/'),
            'view' => ViewLaporanSampah::route('/{record}'),
        ];
    }
}
