<?php

namespace App\Filament\Admin\Resources\TrashReports\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class TrashReportsTable
{
    public static function configure($table)
    {
        return $table
            ->columns([
                TextColumn::make('reporter.name') // Menggunakan relasi reporter yang kamu buat di Model
                    ->label('Pelapor')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('room')
                    ->label('Lab')
                    ->badge()
                    ->color('danger'),

                ImageColumn::make('image')
                    ->label('Bukti'),

                // Menampilkan Matkul dan Kelas yang kena pinalti otomatis
                TextColumn::make('penaltySchedule.subject')
                    ->label('Sesi Terpinalti')
                    ->description(fn($record) => $record->penaltySchedule
                        ? "Kelas {$record->penaltySchedule->class} ({$record->penaltySchedule->time})"
                        : 'Sesi sebelumnya tidak terdeteksi'),

                TextColumn::make('created_at')
                    ->label('Waktu Kejadian')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
