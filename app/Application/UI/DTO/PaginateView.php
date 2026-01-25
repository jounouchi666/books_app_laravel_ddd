<?php

namespace App\Application\UI\DTO;

use App\Application\UI\PaginationUrlGenerator;

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
        private readonly PaginationUrlGenerator $urlGenerator
    ) {}

    /**
     * ページネーションの有無チェック
     *
     * @return bool
     */
    public function hasPagination(): bool
    {
        return $this->onLastPage > 1;
    }
    
    /**
     * URLを生成
     *
     * @param  int $page
     * @return string
     */
    public function pageUrl(int $page): string
    {
        return $this->urlGenerator->pageUrl($page);
    }
        
    /**
     * 前のページのURLを生成
     *
     * @return string
     */
    public function previousPageUrl(): ?string
    {
        return $this->urlGenerator->previousPageUrl();
    }

    /**
     * 次のページのURLを生成
     *
     * @return string
     */
    public function nextPageUrl(): ?string
    {
        return $this->urlGenerator->nextPageUrl();
    }

    /**
     * 最初のページのURLを生成
     *
     * @return string
     */
    public function firstPageUrl(): ?string
    {
        return $this->urlGenerator->firstPageUrl();
    }

    /**
     * 最後のページのURLを生成
     *
     * @return string
     */
    public function lastPageUrl(): ?string
    {
        return $this->urlGenerator->lastPageUrl();
    }
}