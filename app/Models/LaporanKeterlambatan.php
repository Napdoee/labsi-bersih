<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKeterlambatan extends Model
{
    protected $table = 'laporan_keterlambatan';
    protected $primaryKey = 'id_laporan_terlambat';
    public $timestamps = false;
    protected $guarded = [];

    // Relasi ke Mata Kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matkul');
    }

    // Relasi ke Asisten yang terlambat
    public function asisten()
    {
        return $this->belongsTo(Asisten::class, 'id_asisten');
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // Relasi ke User (Pelapor)
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
