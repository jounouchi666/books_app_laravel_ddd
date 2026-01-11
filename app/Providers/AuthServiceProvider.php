<?php

namespace App\Providers;

use App\Application\Auth\AuthorizationPort;
use App\Application\Auth\CurrentUserProvider;
use App\Infrastructure\Auth\LaravelAuthorizationAdapter;
use App\Infrastructure\Auth\LaravelCurrentUserProvider;
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

        $this->app->bind(
            CurrentUserProvider::class,
            LaravelCurrentUserProvider::class
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
