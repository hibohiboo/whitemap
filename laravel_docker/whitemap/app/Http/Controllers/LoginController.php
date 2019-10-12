<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use \Kreait\Firebase\Auth;

class LoginController extends Controller
{
    /**
     * @var Firebase
     */
    private $auth;

    /**
     * コンストラクタインジェクションで $firebase を用意します
     * @param Firebase $firebase
     */
    public function __construct(\Kreait\Firebase\Auth $auth)
    {
        $this->auth = $auth;
    }


    /**
     * 認証を処理する
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $id_token = $request->input('token');

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($id_token);
        } catch (InvalidToken $e) {
            return response()->json([
                'error' => $e->toString(),
            ]);
        }

        $uid = $verifiedIdToken->getClaim('sub');
        $credentials = ['firebase_uid'=> $uid];

        if (Auth::attempt($credentials)) {
            // 認証に成功した
            // return redirect()->intended('home');
            return redirect('/home');
        }else{
            abort(401, 'Unauthorixed');
        }
    }
}