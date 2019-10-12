<?php

namespace App\Providers;
use App\Auth\MySessionGuard; 
use App\Auth\MyEloquentUserProvider; 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth; 
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        $this->app['auth']->extend('my_session', function($app, $name, array $config) {
            $provider = Auth::createUserProvider($config['provider']);
            return new MySessionGuard($name, $provider, $app['session.store']);
        });
 
        Auth::provider('my_eloquent', function($app, array $config) {
            return new MyEloquentUserProvider($app['hash'], $config['model']);
        });
    }
}
