<?php

namespace App\Providers;


use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Repository\BookRepository;
use App\Infrastructure\Persistence\Eloquent\Repository\BookSearchRepository;
use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
        );

        $this->app->bind(
            BookSearchRepositoryInterface::class,
            BookSearchRepository::class
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
