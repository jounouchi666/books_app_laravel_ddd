<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\Category\Repository\CategorySearchRepositoryInterface;
use App\Application\Category\Query\ListCategoryQuery;
use App\Application\UI\DTO\SimplePaginatedResult;
use App\Infrastructure\Persistence\Eloquent\DTO\CategoryRecord;
use App\Models\Category;
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
     * @return SimplePaginatedResult
     */
    public function search(ListCategoryQuery $query): SimplePaginatedResult
    {
        $q = Category::query();

        // ソート
        $q->orderBy($query->sortColumn(), $query->direction);

        $paginater = $q->simplePaginate(
            $query->perPage,
            ['id', 'title'],
            'page',
            $query->page
        );

        return new SimplePaginatedResult(
            CategoryRecord::fromModels($paginater->items()),
            $paginater->currentPage(),
            $paginater->perPage(),
            $paginater->hasMorePages()
        );
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