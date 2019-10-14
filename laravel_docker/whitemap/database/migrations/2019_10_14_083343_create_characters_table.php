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
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('race_id');
            $table->string('firebase_character_id');
            $table->integer('user_id');
            $table->timestamps();
        });
        // 種族
        Schema::create('race', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
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
        Schema::dropIfExists('characters');
    }
}
