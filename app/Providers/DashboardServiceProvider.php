<?php

namespace App\Providers;

use App\Application\Dashboard\Repository\DashboardQueryServiceInterface;
use App\Infrastructure\Persistence\Eloquent\Repository\DashboardQueryService;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            DashboardQueryServiceInterface::class,
            DashboardQueryService::class
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
