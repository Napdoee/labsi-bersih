<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanSampah extends Model
{
    protected $table = 'laporan_sampah';
    protected $primaryKey = 'id_laporan_sampah';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * Relasi ke Ruangan
     */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }

    /**
     * Relasi ke Kelas pelapor
     */
    public function kelasPelapor()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas_pelapor', 'id_kelas');
    }

    /**
     * Relasi ke Kelas yang kena pinalti
     */
    public function kelasPinalti()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas_pinalti', 'id_kelas');
    }

    /**
     * Relasi ke User (pelapor)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
