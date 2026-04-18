<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asisten extends Model
{
    protected $table = 'asisten';
    protected $primaryKey = 'id_asisten';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
