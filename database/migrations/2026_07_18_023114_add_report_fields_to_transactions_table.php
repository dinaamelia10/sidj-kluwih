<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('jenis_laporan')->default('Harian')->after('status');
            $table->string('kategori')->default('Tonase Jagung')->after('jenis_laporan');
            $table->date('tanggal_mulai')->nullable()->after('kategori');
            $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
            $table->text('keterangan')->nullable()->after('tanggal_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['jenis_laporan', 'kategori', 'tanggal_mulai', 'tanggal_selesai', 'keterangan']);
        });
    }
};
