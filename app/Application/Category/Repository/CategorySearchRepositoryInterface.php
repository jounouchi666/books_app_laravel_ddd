<?php

namespace App\Application\Category\Repository;

use App\Application\Category\Query\ListCategoryQuery;
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
     * @return CategoryRecord[]
     */
    public function search(ListCategoryQuery $query): array;
    
    /**
     * 全件取得
     *
     * @return CategoryRecord[]
     */
    public function all(): array;
}