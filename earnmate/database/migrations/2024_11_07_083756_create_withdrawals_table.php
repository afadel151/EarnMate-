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
        Schema::create('withdrawals', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->decimal('amount');
                $table->enum('method',['baridi','binance','bybit'])->default('baridi');
                $table->string('destination');
                $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
                $table->timestamp('processed_at')->default(null);
                $table->enum('status',['pending','completed','declined'])->default('pending');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
