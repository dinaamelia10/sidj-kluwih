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
        Schema::table('market_prices', function (Blueprint $table) {
            $table->string('variety')->default('Pioneer P35')->after('price');
            $table->float('moisture_standard')->default(14.0)->after('variety');
            $table->text('note')->nullable()->after('moisture_standard');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('market_prices', function (Blueprint $table) {
            $table->dropColumn(['variety', 'moisture_standard', 'note']);
        });
    }
};
