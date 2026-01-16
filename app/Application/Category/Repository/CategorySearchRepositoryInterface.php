<?php

namespace App\Application\Category\Repository;

use App\Application\Category\Query\ListCategoryQuery;
use App\Application\UI\DTO\SimplePaginatedResult;
use App\Infrastructure\Persistence\Eloquent\DTO\CategoryRecord;

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
     * @return SimplePaginatedResult
     */
    public function search(ListCategoryQuery $query): SimplePaginatedResult;
    
    /**
     * 全件取得
     *
     * @return CategoryRecord[]
     */
    public function all(): array;
}