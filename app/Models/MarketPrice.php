<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketPrice extends Model
{
    protected $fillable = [
        'price',
        'variety',
        'moisture_standard',
        'note'
    ];
}