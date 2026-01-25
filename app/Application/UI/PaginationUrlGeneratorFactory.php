<?php

namespace App\Application\UI;

/**
 * PaginationUrlGeneratorのインスタンスを作成するためのファクトリー
 */
interface PaginationUrlGeneratorFactory
{
    public function create(
        array $query,
        int $currentPage,
        int $lastPage
    ): PaginationUrlGenerator;
}