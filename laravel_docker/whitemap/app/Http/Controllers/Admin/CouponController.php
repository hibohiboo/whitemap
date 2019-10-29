<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate(config('const.Paginator.PER_PAGE'));
        return view('admin/coupons', [
            'coupons' => $coupons,
            'types' => [ config('const.Coupons.TYPE_GET', 1) => '取得', 
                         config('const.Coupons.TYPE_USE', 2) => '使用']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // bail:最初のバリデーションに失敗したら、残りのバリデーションルールの判定を停止
        $validatedData = $request->validate([
            'id' => 'bail|required|unique:coupons|max:255',
            'name' => 'bail|required|max:255',
            'point' => 'required|integer',
            'type' => 'required|integer'
        ]);

        $coupon = new Coupon();
        $coupon->id = $request->id;
        $coupon->name = $request->name;
        $coupon->point = $request->point;
        $coupon->type = $request->type;
        $coupon->is_display = $request->is_display;
        $coupon->save();

        return redirect('/coupon');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validatedData = $request->validate([
            'name' => 'bail|required|max:255',
            'point' => 'required|integer',
            'type' => 'required|integer'
        ]);
        $coupon->point = $request->point;
        $coupon->save();

        return redirect('/coupon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

}
