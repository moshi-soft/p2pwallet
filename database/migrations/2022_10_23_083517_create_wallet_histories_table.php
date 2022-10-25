<?php

use App\AppConfig;
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
        Schema::create('wallet_histories', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_wallet_id');
            $table->decimal('previous_amount');
            $table->decimal('updated_amount');
            $table->decimal('with_amount');
            $table->enum('currency', explode(',', env('CURRENCIES')));
            $table->enum('action_type', AppConfig::WALLET_ACTION_TYPE);
            $table->tinyInteger('wallet_user_id');
            $table->tinyInteger('related_wallet_user_id');
            $table->integer('transaction_history_id');
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
        Schema::dropIfExists('wallet_histories');
    }
};
