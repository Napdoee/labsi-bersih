<?php

namespace App\Filament\Admin\Resources\Asisten;

use App\Filament\Admin\Resources\Asisten\Pages\CreateAsisten;
use App\Filament\Admin\Resources\Asisten\Pages\EditAsisten;
use App\Filament\Admin\Resources\Asisten\Pages\ListAsisten;
use App\Filament\Admin\Resources\Asisten\Schemas\AsistenForm;
use App\Filament\Admin\Resources\Asisten\Tables\AsistenTable;
use App\Models\Asisten;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AsistenResource extends Resource
{
    protected static ?string $model = Asisten::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Asisten';

    protected static ?string $modelLabel = 'Asisten';

    protected static ?string $pluralModelLabel = 'Asisten';

    protected static UnitEnum|string|null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return AsistenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AsistenTable::configure($table);
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
            'index' => ListAsisten::route('/'),
            'create' => CreateAsisten::route('/create'),
            'edit' => EditAsisten::route('/{record}/edit'),
        ];
    }
}
