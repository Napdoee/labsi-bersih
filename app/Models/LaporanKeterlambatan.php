<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKeterlambatan extends Model
{
    protected $table = 'laporan_keterlambatan';
    protected $primaryKey = 'id_laporan_terlambat';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * Relasi ke Jadwal
     */
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    /**
     * Relasi ke Asisten
     */
    public function asisten()
    {
        return $this->belongsTo(Asisten::class, 'id_asisten', 'id_asisten');
    }

    /**
     * Relasi ke Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    /**
     * Relasi ke Mata Kuliah
     */
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matkul', 'id_matkul');
    }
}
