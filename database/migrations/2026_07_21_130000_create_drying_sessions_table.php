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
        Schema::create('drying_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('batch_name')->default('Batch Main Dryer');
            $table->string('farmer_name')->nullable();
            $table->timestamp('start_time')->useCurrent();
            $table->float('target_duration_hours')->default(3.0); // Misal: 3 jam
            $table->timestamp('end_time')->nullable();
            $table->integer('actual_duration_minutes')->nullable(); // Menit riil beroperasi
            $table->enum('status', ['Berjalan', 'Selesai', 'Dibatalkan'])->default('Berjalan');
            $table->boolean('wa_notified')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drying_sessions');
    }
};
