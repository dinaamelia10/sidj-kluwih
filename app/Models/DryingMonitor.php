<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DryingMonitor extends Model
{
    protected $table = 'drying_monitors';
    
    protected $fillable = [
        'temperature',
        'moisture',
    ];
}