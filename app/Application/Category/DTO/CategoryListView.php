<?php

namespace App\Application\Category\DTO;

/**
 * DTO
 * CategoryListView
 * 
 * 一覧表示用
 * 新規作成権限フラグ付き
 */
final class CategoryListView
{
    public function __construct(
        public readonly array $categoryViews,
        private readonly bool $hasNext,
        private readonly bool $hasPrev,
        public readonly bool $canCreate,
    ) {}

    /**
     * 次ページの存在チェック
     *
     * @return bool
     */
    public function hasNext(): bool
    {
        return $this->hasNext;
    }
    
    /**
     * 前ページの存在チェック
     *
     * @return bool
     */
    public function hasPrev(): bool
    {
        return $this->hasPrev;
    }
    
    /**
     * ページネーションの有無チェック
     *
     * @return bool
     */
    public function hasPagination(): bool
    {
        return $this->hasNext() || $this->hasPrev();
    }
}