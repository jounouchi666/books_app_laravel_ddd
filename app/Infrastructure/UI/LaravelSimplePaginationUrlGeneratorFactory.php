<?php

namespace App\Infrastructure\UI;

use App\Application\UI\SimplePaginationUrlGenerator;
use App\Application\UI\SimplePaginationUrlGeneratorFactory;

/**
 * SimplePaginationUrlGeneratorのインスタンスを作成するためのファクトリー
 */
class LaravelSimplePaginationUrlGeneratorFactory implements SimplePaginationUrlGeneratorFactory
{
    public function create(
        array $query,
        int $currentPage,
        bool $hasNext
    ): SimplePaginationUrlGenerator
    {
        return new LaravelSimplePaginationUrlGenerator(
            request()->route()->getName(),
            $query,
            $currentPage,
            $hasNext
        );
    }
}