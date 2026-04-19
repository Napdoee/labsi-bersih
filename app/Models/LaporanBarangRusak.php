<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanBarangRusak extends Model
{
    protected $table = 'laporan_barang_rusaks';
    protected $primaryKey = 'id_laporan_barang_rusak';

    protected $fillable = [
        'id_ruangan',
        'id_user',
        'nama_barang',
        'no_meja_pc',
        'deskripsi_kerusakan',
        'foto_bukti',
        'status_laporan',
        'waktu_lapor',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
