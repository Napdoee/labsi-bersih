<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TrashReport extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($report) {

            $report->user_id = Auth::id();
            // 1. Ambil waktu sekarang (saat laporan dibuat)
            $now = Carbon::now();
            $hariIni = $now->locale('id')->translatedFormat('l'); // Menghasilkan "Senin", "Selasa", dsb.
            $jamSekarang = $now->format('H:i');

            // 2. Cari jadwal di lab yang sama, pada hari yang sama, 
            // yang waktu selesainya (end_time) sebelum atau sama dengan jam sekarang.
            $sesiTerakhir = Schedule::where('room', $report->room)
                ->where('day', $hariIni)
                ->where('end_time', '<=', $jamSekarang)
                ->orderBy('end_time', 'desc') // Ambil yang paling baru selesai
                ->first();

            // 3. Jika ketemu, masukkan ID jadwal tersebut ke kolom pinalti
            if ($sesiTerakhir) {
                $report->penalty_schedule_id = $sesiTerakhir->id;
            }
        });
    }

    // Relasi ke User (Pelapor)
    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Jadwal yang kena pinalti
    public function penaltySchedule()
    {
        return $this->belongsTo(Schedule::class, 'penalty_schedule_id');
    }
}