<?php

namespace App\Filament\Admin\Resources\Jadwal\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JadwalTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_jadwal')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('mataKuliah.nama_matkul')
                    ->label('Mata Kuliah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kelas.nama_kelas')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ruangan.nama_ruangan')
                    ->label('Ruangan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hari')
                    ->label('Hari')
                    ->badge()
                    ->sortable(),
                TextColumn::make('waktu_mulai')
                    ->label('Mulai')
                    ->sortable(),
                TextColumn::make('waktu_selesai')
                    ->label('Selesai')
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
