<?php

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
    /**
     * タグ一覧表示 / 登録画面表示
     */
    Route::get('/tag', function () {
        $tags = App\Models\Tag::orderBy('created_at', 'asc')->get();

        return view('tags', [
            'tags' => $tags
        ]);
    });

    /**
     * 新タグ追加
     */
    Route::post('/tag', function (Illuminate\Http\Request $request) {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/tag')
                ->withInput()
                ->withErrors($validator);
        }
        $user = $request->user();
        $tag = new App\Models\Tag();
        $tag->name = $request->name;
        $tag->create_user_id = $user->id;
        $tag->save();

        return redirect('/');
    });

    /**
     * タグ削除
     */
    Route::delete('/tag/{tagId}', function (Tag $tagId) {
        //
    });
});
