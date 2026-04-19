<?php

namespace App\Filament\Admin\Resources\LaporanBarangRusaks;

use App\Filament\Admin\Resources\LaporanBarangRusaks\Pages\CreateLaporanBarangRusak;
use App\Filament\Admin\Resources\LaporanBarangRusaks\Pages\EditLaporanBarangRusak;
use App\Filament\Admin\Resources\LaporanBarangRusaks\Pages\ListLaporanBarangRusaks;
use App\Filament\Admin\Resources\LaporanBarangRusaks\Pages\ViewLaporanBarangRusak;
use App\Filament\Admin\Resources\LaporanBarangRusaks\Schemas\LaporanBarangRusakForm;
use App\Filament\Admin\Resources\LaporanBarangRusaks\Schemas\LaporanBarangRusakInfolist;
use App\Filament\Admin\Resources\LaporanBarangRusaks\Tables\LaporanBarangRusaksTable;
use App\Models\LaporanBarangRusak;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaporanBarangRusakResource extends Resource
{
    protected static ?string $model = LaporanBarangRusak::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedComputerDesktop;

    protected static ?string $modelLabel = 'Laporan Barang Rusak';

    protected static ?string $pluralModelLabel = 'Laporan Barang Rusak';

    protected static ?string $recordTitleAttribute = 'nama_barang';

    public static function form(Schema $schema): Schema
    {
        return LaporanBarangRusakForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LaporanBarangRusakInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanBarangRusaksTable::configure($table);
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
            'index' => ListLaporanBarangRusaks::route('/'),
            // 'create' => CreateLaporanBarangRusak::route('/create'),
            'view' => ViewLaporanBarangRusak::route('/{record}'),
            'edit' => EditLaporanBarangRusak::route('/{record}/edit'),
        ];
    }
}
