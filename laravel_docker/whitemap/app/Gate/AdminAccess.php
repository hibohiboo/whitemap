<?php 
declare(strict_types=1);

namespace App\Gate;

use App\User;
use App\Enums\Coupon\CouponIds;

final class AdminAccess
{
    public function __invoke(User $user): bool 
    {
        // 管理者用のクーポンを持っているかDBに問い合わせる。
        return $user->userCoupons()->where('coupon_id',CouponIds::ADMIN())->exists();
    }
}