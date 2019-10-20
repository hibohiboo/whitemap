<?php

use Illuminate\Database\Seeder;
use App\Enums\Coupon\CouponIds;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $coupon = [
            'id' => CouponIds::ADMIN(),
            'name' => '管理者クーポン',
            'is_display' => false,
        ];
        DB::table('coupons')->insert($coupon);
        $coupon = [
            'id' => CouponIds::FIRST_LOGIN(),
            'name' => '初回ログイン',
            'point' => 100,
        ];
        DB::table('coupons')->insert($coupon);
        $coupon = [
            'id' => CouponIds::ADD_CHARACTER(),
            'name' => 'キャラクター追加',
            'point' => -50,
        ];
        DB::table('coupons')->insert($coupon);
    }
}
