<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rate_histories', function (Blueprint $table) {
            $table->id();
            $table->date('requested_date');
            $table->decimal('rate')->nullable();
            $table->decimal('amount');
            $table->decimal('converted_amount')->nullable();
            $table->enum('currency_from', explode(',', env('CURRENCIES')));
            $table->enum('currency_to', explode(',', env('CURRENCIES')));
            $table->tinyInteger('user_id');
            $table->timestamp('rate_datetime');
            $table->boolean('success');
            $table->json('exchangeRateJson');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_rate_historeis');
    }
};
