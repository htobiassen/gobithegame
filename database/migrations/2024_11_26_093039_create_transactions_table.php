<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id'); // Foreign key to the wallets table
            $table->string('token_address'); // Token involved in the transaction
            $table->enum('transaction_type', ['buy', 'sell']);
            $table->decimal('amount', 20, 6); // Amount bought/sold
            $table->decimal('price', 20, 6); // Price of the token
            $table->timestamp('transaction_date'); // Date of the transaction
            $table->timestamps();

            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
