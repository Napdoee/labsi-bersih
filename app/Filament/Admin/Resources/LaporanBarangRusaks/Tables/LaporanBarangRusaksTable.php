<?php

namespace App\Filament\Admin\Resources\LaporanBarangRusaks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class LaporanBarangRusaksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('waktu_lapor')
                    ->label('Waktu Lapor')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('ruangan.nama_ruangan')
                    ->label('Ruangan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.username')
                    ->label('Pelapor')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nama_barang')
                    ->label('Nama Barang')
                    ->searchable(),
                TextColumn::make('no_meja_pc')
                    ->label('No Meja/PC')
                    ->searchable(),
                ImageColumn::make('foto_bukti')
                    ->label('Foto')
                    ->disk('public'),
                TextColumn::make('status_laporan')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Sedang Diperbaiki' => 'info',
                        'Selesai' => 'success',
                    })
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('waktu_lapor', 'desc');
    }
}
