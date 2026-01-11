<?php

namespace App\Providers;

use App\Application\Auth\CurrentUserProvider;
use App\Application\UI\Service\NavigationAuthorizationService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function($view) {
            $currentUser = app(CurrentUserProvider::class)->currentUser();
            $auth = app(NavigationAuthorizationService::class);

            $view->with('isAdmin', $auth->canManage($currentUser));
        });
    }
}
