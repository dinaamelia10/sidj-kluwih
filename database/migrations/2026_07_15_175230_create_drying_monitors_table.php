<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drying_monitors', function (Blueprint $table) {
            $table->id();
            $table->float('temperature'); // Menyimpan suhu (°C)
            $table->float('moisture');    // Menyimpan kadar air/kelembaban (%)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drying_monitors');
    }
};