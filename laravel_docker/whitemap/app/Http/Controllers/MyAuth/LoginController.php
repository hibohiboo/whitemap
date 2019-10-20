<?php
namespace App\Http\Controllers\MyAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @var Firebase
     */
    private $auth;
    private $logger;

    /**
     * コンストラクタインジェクションで $firebase を用意
     * @param Firebase $firebase
     */
    public function __construct(\Kreait\Firebase\Auth $auth, \Psr\LOg\LoggerInterface $logger)
    {
        $this->auth = $auth;
        $this->middleware('guest')->except('logout');
        $this->logger = $logger;
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
            $this->logger->error("invalidToken", $e->toString());
            return response()->json([
                'error' => $e->toString(),
            ]);
        }

        $uid = $verifiedIdToken->getClaim('sub');
        $credentials = ['firebase_uid'=> $uid];

        $firebase_user = $this->auth->getUser($uid);
        $user = \App\User::firstOrCreate(
            ['firebase_uid' => $uid],
            ['name' => $firebase_user->displayName, 
            'twitter_screen_name' => $request->input('twitter_screen_name'),
            'twitter_profile_image_url_https' => $request->input('twitter_profile_image_url_https')]
        );

        if (Auth::attempt($credentials)) {
            // 認証に成功した
            // return redirect()->intended('home');
            return redirect('/home');
        }else{
            abort(401, 'Unauthorixed');
        }
    }

    /**
     * ログアウトする。
     */
    public function logout(){
        Auth::logout();
        return redirect('/home');
    }
}