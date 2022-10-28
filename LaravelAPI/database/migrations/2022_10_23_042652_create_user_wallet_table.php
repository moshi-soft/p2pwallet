<?php

use App\AppConfig;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallet', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->tinyInteger('user_id');
            $table->decimal('amount');
            $table->enum('currency', [env('CURRENCY_USD'),env('CURRENCY_EUR')]);
            $table->enum('action_type', AppConfig::WALLET_ACTION_TYPE);
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
        Schema::dropIfExists('user_wallet');
    }
};
