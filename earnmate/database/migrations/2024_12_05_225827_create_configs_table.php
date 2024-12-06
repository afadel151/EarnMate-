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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->integer('max_balance');
            $table->integer('level_days');
            $table->integer('baridi_tax_percentage');
            $table->integer('binance_tax_percentage');
            $table->integer('dzd_price');
            $table->timestamps();
        });
        DB::table('configs')->insert([
            'max_balance' => 1200,
            'level_days' =>5,
            'baridi_tax_percentage' => 10,
            'binance_tax_percentage' => 5,
            'dzd_price' => 254
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
