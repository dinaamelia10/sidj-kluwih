<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    protected $fillable = [
        'nama',
        'no_telp',
        'alamat',
        'wilayah',
        'luas_lahan',
        'komoditas',
        'status',
    ];
}
