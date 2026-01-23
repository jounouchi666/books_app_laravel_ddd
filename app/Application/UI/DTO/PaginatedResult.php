<?php

namespace App\Application\UI\DTO;

final class PaginatedResult
{
    public function __construct(
        public readonly array $records,
        public readonly int $currentPage,
        public readonly int $lastPage,
        public readonly int $perPage,
        public readonly int $total,
        public readonly bool $onFirstPage,
        public readonly bool $onLastPage,
        public readonly ?string $nextPageUrl,
        public readonly ?string $previousPageUrl
    ) {}
}