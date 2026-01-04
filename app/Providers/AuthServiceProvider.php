<?php

namespace App\Providers;

use App\Application\Auth\AuthorizationPort;
use App\Infrastructure\Auth\LaravelAuthorizationAdapter;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthorizationPort::class,
            LaravelAuthorizationAdapter::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
