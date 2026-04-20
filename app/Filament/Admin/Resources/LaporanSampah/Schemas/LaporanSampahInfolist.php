<?php

namespace App\Filament\Admin\Resources\LaporanSampah\Schemas;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class LaporanSampahInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('waktu_lapor')
                    ->label('Waktu Lapor')
                    ->dateTime('d M Y, H:i'),
                
                TextEntry::make('ruangan.nama_ruangan')
                    ->label('Ruangan'),
                
                TextEntry::make('kelasPelapor.nama_kelas')
                    ->label('Pelapor')
                    ->default(fn ($record) => $record->user?->asisten?->nama_asisten ? $record->user->asisten->nama_asisten . ' (Asisten)' : ($record->user?->username ?? '-')),
                
                TextEntry::make('kelasPinalti.nama_kelas')
                    ->label('Kelas Pinalti')
                    ->default('Tidak terdeteksi')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'Tidak terdeteksi' ? 'gray' : 'danger'),
                
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu' => 'warning',
                        'diverifikasi' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextEntry::make('deskripsi')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                
                ImageEntry::make('foto_sampah')
                    ->label('Foto Bukti')
                    ->disk('public')
                    ->height(300)
                    ->columnSpanFull(),
            ]);
    }
}
