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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->decimal('required_amount');
            $table->integer('real_max_users');
            $table->integer('fake_max_users');
            $table->enum('method',['binance','bybit','baridi','all'])->default('all');
            $table->integer('days');
            $table->date('start_date');
            $table->time('start_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
