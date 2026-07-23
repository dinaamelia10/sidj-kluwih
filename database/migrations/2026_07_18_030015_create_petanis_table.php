<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petanis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                         // Nama lengkap petani
            $table->string('no_telp')->nullable();          // Nomor telepon
            $table->string('alamat')->nullable();           // Alamat lengkap
            $table->string('wilayah')->nullable();          // Wilayah/desa (Kluwih Utara, dll)
            $table->decimal('luas_lahan', 8, 2)->nullable(); // Luas lahan dalam Hektar
            $table->string('komoditas')->default('Jagung Hibrida'); // Jenis komoditas
            $table->string('status')->default('Aktif');     // Aktif / Tidak Aktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petanis');
    }
};
