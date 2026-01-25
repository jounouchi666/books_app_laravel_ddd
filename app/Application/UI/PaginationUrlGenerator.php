<?php

namespace App\Application\UI;

/**
 * インターフェース
 * PaginationUrlGenerator
 * 
 * ページネーション用のURLを生成する
 */
interface PaginationUrlGenerator
{
        
    /**
     * ページ指定
     *
     * @param  int $page
     * @return string
     */
    public function pageUrl(int $page): string;

        
    /**
     * 前のページ
     *
     * @return string
     */
    public function previousPageUrl(): ?string;

    /**
     * 次のページ
     *
     * @return string
     */
    public function nextPageUrl(): ?string;

    /**
     * 最初のページ
     *
     * @return string
     */
    public function firstPageUrl(): ?string;

    /**
     * 最後のページ
     *
     * @return string
     */
    public function lastPageUrl(): ?string;
}