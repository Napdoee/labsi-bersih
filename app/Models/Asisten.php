<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asisten extends Model
{
    protected $table = 'asisten';
    protected $primaryKey = 'id_asisten';
    public $timestamps = false;
    protected $guarded = [];
}
