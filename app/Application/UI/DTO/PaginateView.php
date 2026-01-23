<?php

namespace App\Application\UI\DTO;

/**
 * DTO
 * PaginateView
 * 
 * Pagination用
 */
final class PaginateView
{
    public function __construct(
        public readonly int $currentPage,
        public readonly int $lastPage,
        public readonly int $perPage,
        public readonly int $total,
        public readonly bool $onFirstPage,
        public readonly bool $onLastPage,
        public readonly ?string $nextPageUrl,
        public readonly ?string $previousPageUrl
    ) {}

    /**
     * ページネーションの有無チェック
     *
     * @return bool
     */
    public function hasPagination(): bool
    {
        return !$this->onFirstPage || !$this->onLastPage;
    }
}