<?php

namespace App\Infrastructure\UI;

use App\Application\UI\PaginationUrlGenerator;
use App\Application\UI\PaginationUrlGeneratorFactory;

/**
 * PaginationUrlGeneratorのインスタンスを作成するためのファクトリー
 */
class LaravelPaginationUrlGeneratorFactory implements PaginationUrlGeneratorFactory
{
    public function create(
        array $query,
        int $currentPage,
        int $lastPage        
    ): PaginationUrlGenerator
    {
        return new LaravelPaginationUrlGenerator(
            request()->route()->getName(),
            $query,
            $currentPage,
            $lastPage
        );
    }
}