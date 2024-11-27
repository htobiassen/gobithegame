<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletPortfolioTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_portfolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id');
            $table->string('token_address'); // Address of the token
            $table->string('token_name'); // Name of the token
            $table->decimal('token_balance', 20, 8); // Token balance
            $table->decimal('price', 20, 8)->nullable(); // Price of the token
            $table->decimal('value', 20, 8)->nullable(); // Value in USD
            $table->decimal('percentage', 5, 2)->nullable(); // Percentage of total portfolio
            $table->timestamps();

            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_portfolios');
    }
}
