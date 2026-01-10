<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\Category\Repository\CategorySearchRepositoryInterface;
use App\Application\Category\Query\ListCategoryQuery;
use App\Infrastructure\Persistence\Eloquent\DTO\CategoryRecord;
use Illuminate\Support\Facades\DB;

/**
 * リポジトリー
 * CategorySearch
 */
class CategorySearchRepository implements CategorySearchRepositoryInterface
{
    /**
     * 検索
     *
     * @param  ListCategoryQuery $query
     * @return CategoryRecord[]
     */
    public function search(ListCategoryQuery $query): array
    {
        $q = DB::table('categories');

        // ソート
        $q->orderBy($query->sortColumn(), $query->direction);

        return $q->get()
            ->map(fn($model) => new CategoryRecord(
              $model->id,
              $model->title
            ))
            ->all();
    }

    /**
     * 全件取得
     *
     * @return CategoryRecord[]
     */
    public function all(): array
    {
        return DB::table('categories')
            ->orderBy('id')
            ->get()
            ->map(fn($model) => new CategoryRecord(
              $model->id,
              $model->title
            ))
            ->all();
    }
}