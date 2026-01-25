<?php

namespace App\Providers;

use App\Application\UI\PaginationUrlGenerator;
use App\Application\UI\PaginationUrlGeneratorFactory;
use App\Application\UI\SimplePaginationUrlGenerator;
use App\Application\UI\SimplePaginationUrlGeneratorFactory;
use App\Infrastructure\UI\LaravelPaginationUrlGenerator;
use App\Infrastructure\UI\LaravelPaginationUrlGeneratorFactory;
use App\Infrastructure\UI\LaravelSimplePaginationUrlGenerator;
use App\Infrastructure\UI\LaravelSimplePaginationUrlGeneratorFactory;
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

        $this->app->bind(
            SimplePaginationUrlGenerator::class,
            LaravelSimplePaginationUrlGenerator::class
        );

        $this->app->bind(
            SimplePaginationUrlGeneratorFactory::class,
            LaravelSimplePaginationUrlGeneratorFactory::class
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
