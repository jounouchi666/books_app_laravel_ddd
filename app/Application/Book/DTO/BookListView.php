<?php

namespace App\Application\Book\DTO;

use App\Application\UI\DTO\PaginateView;

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
        public readonly bool $canCreate,
        public readonly array $users,
        public readonly PaginateView $paginateView,
        public readonly BookUIQuery $bookUIQuery
    ) {}
}