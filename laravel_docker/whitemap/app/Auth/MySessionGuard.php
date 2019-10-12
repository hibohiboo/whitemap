<?php
namespace App\Auth; 
 
use Illuminate\Auth\SessionGuard; 
use Illuminate\Contracts\Session\Session; 
use Illuminate\Contracts\Auth\UserProvider; 
use Symfony\Component\HttpFoundation\Request; 
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract; 
 
class MySessionGuard extends SessionGuard { 
 
    protected function cycleRememberToken(AuthenticatableContract $user) { 
//        $user->setRememberToken($token = Str::random(60));
//        $this->provider->updateRememberToken($user, $token);
    }
}