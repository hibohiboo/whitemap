<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coupon_id')->comment('クーポンID');
            $table->integer('subscribe_user_id')->unsigned()->comment('受取ユーザID');
            $table->integer('publish_user_id')->unsigned()->comment('発行ユーザID');
            $table->dateTime('expire')->nullable()->comment('利用期限');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('subscribe_user_id')->references('id')->on('users');
            $table->foreign('publish_user_id')->references('id')->on('users');
            $table->foreign('coupon_id')->references('id')->on('coupons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_coupons');
    }
}
