<?php

namespace App\Application\UI;

/**
 * インターフェース
 * SimplePaginationUrlGenerator
 * 
 * シンプルページネーション用のURLを生成する
 */
interface SimplePaginationUrlGenerator
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
}