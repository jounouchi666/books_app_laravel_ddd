<?php

namespace App\Application\Category\Repository;

use App\Application\Category\DTO\CategoryView;
use App\Application\Category\Query\ListCategoryQuery;

/**
 * インターフェース
 * SearchCategry
 * ドメイン層のCategoryとは分離
 */
interface CategorySearchRepositoryInterface
{
    /**
     * 検索
     *
     * @param  ListCategoryQuery $query
     * @return CategoryView[]
     */
    public function search(ListCategoryQuery $query): array;
}