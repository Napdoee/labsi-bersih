<?php

namespace App\Filament\Admin\Resources\LaporanKeterlambatans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LaporanKeterlambatansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('waktu_lapor')
                    ->label('Waktu Lapor')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('kelas.nama_kelas')
                    ->label('Kelas Pelapor')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jadwal.mataKuliah.nama_matkul')
                    ->label('Mata Kuliah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('asisten.nama_asisten')
                    ->label('Nama Asisten')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('keterlambatan')
                    ->label('Terlambat')
                    ->suffix(' Menit')
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        $state == 0 => 'success',
                        $state <= 15 => 'warning',
                        default => 'danger',
                    })
                    ->sortable(),

                TextColumn::make('deskripsi')
                    ->label('Keterangan')
                    ->limit(30)
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
                    // DeleteBulkAction::make(), default ini tapi nd usah dipake
                ]),
            ])
            ->defaultSort('waktu_lapor', 'desc');
    }
}
