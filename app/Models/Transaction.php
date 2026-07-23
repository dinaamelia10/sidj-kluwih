<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'farmer_name', 'tonnage', 'status',
        'jenis_laporan', 'kategori',
        'tanggal_mulai', 'tanggal_selesai', 'keterangan',
    ];
}