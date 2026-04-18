<?php

namespace App\Filament\Admin\Resources\Ruangan\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RuanganForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_ruangan')
                    ->label('Nama Ruangan')
                    ->maxLength(50)
                    ->required(),
            ]);
    }
}
