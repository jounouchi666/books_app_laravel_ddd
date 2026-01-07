<?php

namespace App\Application\Category\DTO;

/**
 * DTO
 * CategoryListView
 * 
 * 一覧表示用
 * 新規作成権限フラグ付き
 */
class CategoryListView
{
    public function __construct(
        public readonly array $categoryViews,
        public readonly bool $canCreate
    ) {}
}