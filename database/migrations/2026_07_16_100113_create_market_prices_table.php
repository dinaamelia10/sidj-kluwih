<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('market_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('price')->unsigned(); // Menyimpan harga rupiah per kg (misal: 5500)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('market_prices');
    }
};