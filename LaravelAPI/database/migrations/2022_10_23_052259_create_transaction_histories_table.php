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
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('transaction_by')->comment('user_id');
            $table->tinyInteger('transaction_to')->comment('user_id');
            $table->enum('transaction_from_currency', explode(',', env('CURRENCIES')));
            $table->enum('transaction_to_currency', explode(',', env('CURRENCIES')));
            $table->decimal('transaction_rate');
            $table->decimal('applied_amount');
            $table->decimal('converted_amount');
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
        Schema::dropIfExists('transaction_histories');
    }
};
