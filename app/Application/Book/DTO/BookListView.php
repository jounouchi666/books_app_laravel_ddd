<?php

namespace App\Application\Book\DTO;

/**
 * DTO
 * BookListView
 * 
 * 一覧表示用
 * 新規作成権限フラグ付き
 */
class BookListView
{
    public function __construct(
        public readonly array $bookViews,
        public readonly bool $canCreate
    ) {}
}