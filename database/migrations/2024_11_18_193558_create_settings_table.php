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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('slippage', 5, 2)->default(0.5);
            $table->decimal('take_profit', 8, 2)->default(10.00);
            $table->decimal('stop_loss', 8, 2)->default(5.00);
            $table->decimal('price_impact', 5, 2)->default(1.00);
            $table->string('tx_priority')->default('normal');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
