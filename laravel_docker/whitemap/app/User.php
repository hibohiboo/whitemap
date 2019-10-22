<?php

namespace App;

use Laravel\Passport\HasApiTokens; // 追加
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\Coupon\CouponIds;
class User extends Authenticatable
{
    use Notifiable, HasApiTokens; // HasApiTokens を追加
    public function __construct(array $attributes = []){
        parent::__construct($attributes);
        // $coupons = $this->userCoupons;
        // var_dump($coupons->select(['id'])->get());
        // exit;
        // $ids = array_column($coupons, 'id');
        // $this->isAdmin = in_array(CouponIds::ADMIN(), $ids, true);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'twitter_screen_name','twitter_profile_image_url_https', 'firebase_uid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userCoupons(){
        return $this->hasMany('App\Models\UserCoupon',  'subscribe_user_id');
    }
}
