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
        Schema::create('token_checks', function (Blueprint $table) {
            $table->id();
            $table->string('token_address')->unique();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->json('links')->nullable();
            $table->string('chain_id');
            $table->string('token_program')->nullable();
            $table->json('risks')->nullable(); // Store risks as JSON
            $table->integer('overall_score')->nullable(); // Overall score
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_checks');
    }
};
