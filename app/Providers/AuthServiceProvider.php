<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user) {
            return get_class($user) === 'App\Models\Admin';
        });

        Gate::define('isUser', function($user) {
            return get_class($user) === 'App\Models\User';
        });

        Gate::define('isLogin', function($user) {
            return get_class($user) === 'App\Models\User' or get_class($user) === 'App\Models\Admin';
        });
    }
}
