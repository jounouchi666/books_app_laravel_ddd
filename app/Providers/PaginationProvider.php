<?php

namespace App\Providers;

use App\Application\UI\PaginationUrlGenerator;
use App\Application\UI\PaginationUrlGeneratorFactory;
use App\Infrastructure\UI\LaravelPaginationUrlGenerator;
use App\Infrastructure\UI\LaravelPaginationUrlGeneratorFactory;
use Illuminate\Support\ServiceProvider;

class PaginationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            PaginationUrlGenerator::class,
            LaravelPaginationUrlGenerator::class
        );

        $this->app->bind(
            PaginationUrlGeneratorFactory::class,
            LaravelPaginationUrlGeneratorFactory::class
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
