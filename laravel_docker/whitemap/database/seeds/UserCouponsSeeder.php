<?php

use Illuminate\Database\Seeder;
use App\Enums\Coupon\CouponIds;
class UserCouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_coupon = [
            'id' => 1,
            'coupon_id' => CouponIds::ADMIN(),
            'subscribe_user_id' => 2,
            'publish_user_id' => 1,
        ];
        DB::table('user_coupons')->insert($user_coupon);
    }
}
