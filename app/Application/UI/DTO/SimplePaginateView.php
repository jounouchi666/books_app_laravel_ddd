<?php

namespace App\Application\UI\DTO;

use App\Application\UI\SimplePaginationUrlGenerator;

/**
 * DTO
 * SimplePaginateView
 * 
 * SimplePagination用
 */
final class SimplePaginateView
{
    private readonly bool $hasNext;
    private readonly bool $hasPrev;
    public readonly bool $onFirstPage; // BladeでPaginateと同様に呼び出せるように
    public readonly bool $onLastPage;  // BladeでPaginateと同様に呼び出せるように
    private readonly SimplePaginationUrlGenerator $urlGenerator;

    public function __construct(
        bool $hasNext,
        bool $hasPrev,
        SimplePaginationUrlGenerator $urlGenerator
    ) {
        $this->hasNext = $hasNext;
        $this->hasPrev = $hasPrev;
        $this->onFirstPage = !$this->hasPrev;
        $this->onLastPage = !$this->hasNext;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * ページネーションの有無チェック
     *
     * @return bool
     */
    public function hasPagination(): bool
    {
        return $this->hasNext || $this->hasPrev;
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
}