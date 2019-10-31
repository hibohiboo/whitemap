<?php
use App\Enums\Coupon\CouponIds;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});
Route::get('/agreement', function () {
    return view('agreement');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', 'MyAuth\LoginController@authenticate');
Route::get('/logout', 'MyAuth\LoginController@logout');


Route::get('/home', function () {
    Log::info("Hello my log,");
    return view('home');
});

Route::group(['middleware' => ['auth']], function () {
    // この中はログインされている場合のみルーティングされる

});

Route::group(['middleware' => ['auth', 'can:admin-access']], function () {
    // この中は管理者権限の場合のみルーティングされる
    /**
     * 管理者ダッシュボード
     */
    Route::get('/admin', function (Illuminate\Http\Request $request) {
        return view('admin/dashboard');
    });
    /**
     * タグ一覧表示 / 登録画面表示
     */
    Route::get('/tag','Admin\TagController@index');

    /**
     * 新タグ追加
     */
    Route::post('/tag','Admin\TagController@store');

    /**
     * タグ更新
     */
    Route::put('/tag/{tag}','Admin\TagController@update');

    /**
     * クーポン一覧表示 / 登録画面表示
     */
    Route::get('/coupon','Admin\CouponController@index');

    /**
     * 新クーポン追加
     */
    Route::post('/coupon','Admin\CouponController@store');

    /**
     * クーポン更新
     */
    Route::put('/coupon/{coupon}','Admin\CouponController@update');
    /**
     * クーポン削除
     */
    Route::delete('/coupon/{coupon}','Admin\CouponController@destroy');
});
