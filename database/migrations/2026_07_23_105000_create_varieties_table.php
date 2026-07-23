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
        Schema::create('varieties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        
        // Insert default data
        \Illuminate\Support\Facades\DB::table('varieties')->insert([
            ['name' => 'Pioneer P35', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'NK Sumo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bisi 18', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Advanta ADV 777', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varieties');
    }
};
