<?php

namespace App\Filament\Admin\Resources\Asisten\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AsistenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_asisten')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('user.username')
                    ->label('NIM')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_asisten')
                    ->label('Nama Asisten')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
