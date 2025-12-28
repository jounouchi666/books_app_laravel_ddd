<?php

namespace App\Providers;

use App\Application\Category\Repository\CategorySearchRepositoryInterface;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Repository\CategoryRepository;
use App\Infrastructure\Persistence\Eloquent\Repository\CategorySearchRepository;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            CategorySearchRepositoryInterface::class,
            CategorySearchRepository::class
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
