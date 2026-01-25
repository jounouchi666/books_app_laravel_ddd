<?php

namespace App\Infrastructure\UI;

use App\Application\UI\PaginationUrlGenerator;

/**
 * LaravelPaginationUrlGenerator
 * 
 * LaravelGateを用いたページネーション用URL生成クラス
 */
class LaravelPaginationUrlGenerator implements PaginationUrlGenerator
{
    public function __construct(
        private readonly string $routeName,
        private readonly array $query,
        private readonly int $currentPage,
        private readonly int $lastPage
    ) {}

    /**
     * ページ指定
     *
     * @param  int $page
     * @return string
     */
    public function pageUrl(int $page): string
    {
        return route(
            $this->routeName,
            array_merge($this->query, ['page' => $page])
        );
    }
        
    /**
     * 前のページ
     *
     * @return string
     */
    public function previousPageUrl(): ?string
    {
        return $this->currentPage > 1
            ? $this->pageUrl($this->currentPage - 1)
            : null;
    }

    /**
     * 次のページ
     *
     * @return string
     */
    public function nextPageUrl(): ?string
    {
        return $this->currentPage < $this->lastPage
            ? $this->pageUrl($this->currentPage + 1)
            : null;
    }

    /**
     * 最初のページ
     *
     * @return string
     */
    public function firstPageUrl(): ?string
    {
        return $this->pageUrl(1);
    }

    /**
     * 最後のページ
     *
     * @return string
     */
    public function lastPageUrl(): ?string
    {
        return $this->pageUrl($this->lastPage);
    }
}