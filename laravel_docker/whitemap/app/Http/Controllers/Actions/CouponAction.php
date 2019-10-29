<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponAction extends Controller
{
    /**
     * 存在していなければtrueを返す
     */
    public function unique(Request $request)
    {
        $result = true;
        if ($request->has('id')) {
            $result = ! Coupon::where('id', '=', $request->query('id'))->exists();
        }
        return response()->json($result);
    }
}
