<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // キャラクター
        Schema::create('characters', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->integer('user_coupon_id')->unsigned();;
            $table->integer('race_id')->unsigned(); // 種族
            $table->integer('user_id')->unsigned(); // 作成者
            $table->string('character_icon_url');
            $table->integer('used_point');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('race_id')->references('id')->on('race');
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
