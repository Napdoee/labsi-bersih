<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailAsisten extends Model
{
    protected $table = 'detail_asisten';
    protected $primaryKey = 'id_detail_asisten';
    public $timestamps = false;
    protected $guarded = [];
}
