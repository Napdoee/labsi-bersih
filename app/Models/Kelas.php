<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * Relasi ke model User (Dosen)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
