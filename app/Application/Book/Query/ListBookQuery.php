<?php

namespace App\Application\Book\Query;

/**
 * クエリオブジェクト
 * Book検索用
 */
class ListBookQuery
{
    public function __construct(
        public ?int $userId = null,
        public ?int $categoryId = null,
        public string $sort = 'created_at',
        public string $direction = 'desc'
    ) {}
}