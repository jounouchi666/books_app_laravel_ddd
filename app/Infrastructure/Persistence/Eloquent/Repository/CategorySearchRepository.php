<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\Category\Repository\CategorySearchRepositoryInterface;
use App\Application\Category\DTO\CategoryView;
use App\Application\Category\Query\ListCategoryQuery;
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
     * @return CategoryView[]
     */
    public function search(ListCategoryQuery $query): array
    {
        $q = DB::table('categories');

        // ソート
        $q->orderBy($query->sortColumn(), $query->direction);

        return $q->get()
            ->map(fn($model) => new CategoryView(
              $model->id,
              $model->title
            ))
            ->all();
    }
}