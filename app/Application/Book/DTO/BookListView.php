<?php

namespace App\Application\Book\DTO;

/**
 * DTO
 * BookListView
 * 
 * 一覧表示用
 * 新規作成権限フラグ付き
 */
final class BookListView
{
    public function __construct(
        public readonly array $bookViews,
        public readonly int $currentPage,
        public readonly int $lastPage,
        public readonly int $perPage,
        public readonly int $total,
        public readonly bool $canCreate,
        public readonly BookUIQuery $bookUIQuery
    ) {}
    
    /**
     * 次ページの存在チェック
     *
     * @return bool
     */
    public function hasNext(): bool
    {
        return $this->currentPage < $this->lastPage;
    }
    
    /**
     * 前ページの存在チェック
     *
     * @return bool
     */
    public function hasPrev(): bool
    {
        return $this->currentPage > 1;
    }
}