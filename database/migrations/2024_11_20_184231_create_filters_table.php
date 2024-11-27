<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltersTable extends Migration
{
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {

                $table->id();

                // Liquidity
                $table->decimal('min_liquidity', 15, 2)->nullable();
                $table->decimal('max_liquidity', 15, 2)->nullable();

                // Market cap
                $table->decimal('min_market_cap', 15, 2)->nullable();
                $table->decimal('max_market_cap', 15, 2)->nullable();

                // FDV
                $table->decimal('min_fdv', 15, 2)->nullable();
                $table->decimal('max_fdv', 15, 2)->nullable();

                // Pair age
                $table->integer('min_pair_age_hours')->nullable();
                $table->integer('max_pair_age_hours')->nullable();

                // 24-hour metrics
                $table->integer('min_24h_txns')->nullable();
                $table->integer('max_24h_txns')->nullable();
                $table->integer('min_24h_buys')->nullable();
                $table->integer('max_24h_buys')->nullable();
                $table->integer('min_24h_sells')->nullable();
                $table->integer('max_24h_sells')->nullable();
                $table->decimal('min_24h_volume', 15, 2)->nullable();
                $table->decimal('max_24h_volume', 15, 2)->nullable();
                $table->decimal('min_24h_change_percent', 5, 2)->nullable();
                $table->decimal('max_24h_change_percent', 5, 2)->nullable();

                // 6-hour metrics
                $table->integer('min_6h_txns')->nullable();
                $table->integer('max_6h_txns')->nullable();
                $table->integer('min_6h_buys')->nullable();
                $table->integer('max_6h_buys')->nullable();
                $table->integer('min_6h_sells')->nullable();
                $table->integer('max_6h_sells')->nullable();
                $table->decimal('min_6h_volume', 15, 2)->nullable();
                $table->decimal('max_6h_volume', 15, 2)->nullable();
                $table->decimal('min_6h_change_percent', 5, 2)->nullable();
                $table->decimal('max_6h_change_percent', 5, 2)->nullable();

                // 1-hour metrics
                $table->integer('min_1h_txns')->nullable();
                $table->integer('max_1h_txns')->nullable();
                $table->integer('min_1h_buys')->nullable();
                $table->integer('max_1h_buys')->nullable();
                $table->integer('min_1h_sells')->nullable();
                $table->integer('max_1h_sells')->nullable();
                $table->decimal('min_1h_volume', 15, 2)->nullable();
                $table->decimal('max_1h_volume', 15, 2)->nullable();
                $table->decimal('min_1h_change_percent', 5, 2)->nullable();
                $table->decimal('max_1h_change_percent', 5, 2)->nullable();

                // 5-minute metrics
                $table->integer('min_5m_txns')->nullable();
                $table->integer('max_5m_txns')->nullable();
                $table->integer('min_5m_buys')->nullable();
                $table->integer('max_5m_buys')->nullable();
                $table->integer('min_5m_sells')->nullable();
                $table->integer('max_5m_sells')->nullable();
                $table->decimal('min_5m_volume', 15, 2)->nullable();
                $table->decimal('max_5m_volume', 15, 2)->nullable();
                $table->decimal('min_5m_change_percent', 5, 2)->nullable();
                $table->decimal('max_5m_change_percent', 5, 2)->nullable();

                $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('filters');
    }
}
