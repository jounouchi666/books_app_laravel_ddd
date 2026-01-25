<?php

namespace App\Application\UI;

/**
 * SimplePaginationUrlGeneratorのインスタンスを作成するためのファクトリー
 */
interface SimplePaginationUrlGeneratorFactory
{
    public function create(
        array $query,
        int $currentPage,
        bool $hasNext
    ): SimplePaginationUrlGenerator;
}