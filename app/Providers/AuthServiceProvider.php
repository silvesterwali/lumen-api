<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\User;
use App\Policies\ModulePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {

        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        $this->registerGate();

        $this->app['auth']->viaRequest('api', function ($request) {
            return app('auth')->setRequest($request)->user();
        });

    }
    public function registerGate()
    {
        Gate::policy(Module::class, ModulePolicy::class);

        Gate::define('create-module', function ($user) {
            return $user->isAdmin();
        });

    }

}
