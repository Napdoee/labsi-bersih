<?php

namespace App\Filament\Admin\Resources\Asisten\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AsistenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_asisten')
                    ->label('Nama Asisten')
                    ->required(),
                Select::make('id_user')
                    ->label('User')
                    ->relationship('user', 'username')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
