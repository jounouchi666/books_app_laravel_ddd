<?php

namespace App\Application\UI\DTO;

final class SimplePaginatedResult
{
    public readonly array $records;
    public readonly int $currentPage;
    public readonly int $perPage;
    public readonly bool $hasNext;
    public readonly bool $hasPrev;

    public function __construct(
        array $records,
        int $currentPage,
        int $perPage,
        bool $hasMorePages
    ) {
        $this->records = $records;
        $this->currentPage = $currentPage;
        $this->perPage = $perPage;
        $this->hasNext = $hasMorePages;
        $this->hasPrev = $this->currentPage > 1;
    }
}