<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Http\JsonResponse;
use \Kreait\Firebase\Auth;

class LoginAction extends Controller
{
    /**
     * @var Firebase
     */
    private $firebase;

    /**
     * コンストラクタインジェクションで $firebase を用意します
     * @param Firebase $firebase
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * シングルアクションコントローラです。 /api/auth に POST されると、これが実行されます
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $id_token = $request->input('idToken');

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($id_token);
        } catch (InvalidToken $e) {
            return response()->json([
                'error' => 'error!!',
            ]);
        }

        $uid = $verifiedIdToken->getClaim('sub');
        $firebase_user = $this->auth->getUser($uid);
        return response()->json([
            'uid' => $uid,
            'name' => $firebase_user->displayName,
        ]);
    }
}