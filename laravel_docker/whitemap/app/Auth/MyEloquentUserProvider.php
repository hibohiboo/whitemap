<?php
namespace App\Auth; 
 
use Illuminate\Auth\EloquentUserProvider; 
use Illuminate\Contracts\Hashing\Hasher as HasherContract; 
use Illuminate\Contracts\Auth\Authenticatable as UserContract; 
 
class MyEloquentUserProvider extends EloquentUserProvider 
{  
    public function validateCredentials(UserContract $user, array $credentials) 
    { 
        // パスワード認証しない
        return true;
    // $plain = $credentials['password']; 
    // // プレーンなパスワードによる認証 
    // return $plain==$user->getAuthPassword();
 
    // ハッシュ値による認証
//  return $this->hasher->check($plain, $user->getAuthPassword());
    }
}