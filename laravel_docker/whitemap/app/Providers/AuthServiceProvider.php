<?php

namespace App\Providers;
use App\Auth\MySessionGuard; 
use App\Auth\MyEloquentUserProvider; 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth; 
use App\Gate\UserAccess; 
use App\Gate\AdminAccess; 
use \Psr\Log\LoggerInterface;

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
    public function boot(LoggerInterface $logger)
    {
        $this->registerPolicies();
        //
 
        Auth::provider('my_eloquent', function($app, array $config) {
            return new MyEloquentUserProvider($app['hash'], $config['model']);
        });

        // 認可
        Gate::define('admin-access', new AdminAccess);
        // 認可
        Gate::define('user-access', new UserAccess);
        // 認可の前にロギング
        Gate::before(function ($user, $ability) use ($logger) {
            // Log::info("Hello my log,");
            $logger->info($ability, ['firebase_uid'=>$user->getAuthIdentifier()]);
        });
    }
}
