<?php

namespace App\Filament\Admin\Resources\LaporanSampah\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LaporanSampahTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('waktu_lapor')
                    ->label('Waktu Lapor')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('ruangan.nama_ruangan')
                    ->label('Ruangan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kelasPelapor.nama_kelas')
                    ->label('Pelapor')
                    ->default(fn ($record) => $record->user?->asisten?->nama_asisten ? $record->user->asisten->nama_asisten . ' (Asisten)' : ($record->user?->username ?? '-'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kelasPinalti.nama_kelas')
                    ->label('Kelas Pinalti')
                    ->default('Tidak terdeteksi')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'Tidak terdeteksi' ? 'gray' : 'danger'),

                ImageColumn::make('foto_sampah')
                    ->label('Foto')
                    ->disk('public')
                    ->width(80)
                    ->height(60),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu' => 'warning',
                        'diverifikasi' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),

                TextColumn::make('deskripsi')
                    ->label('Keterangan')
                    ->limit(30)
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'menunggu'     => 'Menunggu',
                        'diverifikasi' => 'Diverifikasi',
                        'ditolak'      => 'Ditolak',
                    ]),
            ])
            ->recordActions([
                Action::make('verifikasi')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi Laporan')
                    ->modalDescription('Apakah Anda yakin ingin memverifikasi laporan ini? Pinalti akan dikonfirmasi.')
                    ->action(fn ($record) => $record->update(['status' => 'diverifikasi']))
                    ->visible(fn ($record) => $record->status === 'menunggu'),

                Action::make('tolak')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Laporan')
                    ->modalDescription('Apakah Anda yakin ingin menolak laporan ini?')
                    ->action(fn ($record) => $record->update(['status' => 'ditolak']))
                    ->visible(fn ($record) => $record->status === 'menunggu'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ])
            ->defaultSort('waktu_lapor', 'desc');
    }
}
