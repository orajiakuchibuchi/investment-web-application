<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBullBearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bull_bears', function (Blueprint $table) {
            $table->id();
            $table->enum('action', ['Invested', 'Withdrew']);
            $table->enum('coin', ['BTC', 'ETH', 'USDT']);
            $table->longText('address');
            $table->integer('amount');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('bull_bears');
    }
}
