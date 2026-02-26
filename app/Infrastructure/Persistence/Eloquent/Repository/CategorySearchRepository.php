<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\Category\Repository\CategorySearchRepositoryInterface;
use App\Application\Category\Query\ListCategoryQuery;
use App\Application\Shared\Enum\TrashType;
use App\Application\UI\DTO\SimplePaginatedResult;
use App\Infrastructure\Persistence\Eloquent\DTO\CategoryRecord;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

/**
 * リポジトリー
 * CategorySearch
 */
class CategorySearchRepository implements CategorySearchRepositoryInterface
{
    private const SORT_COLUMNS = [
        'title'      => 'categories.title',
        'created_at' => 'categories.created_at'
    ];

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
        $q->orderBy(
            self::SORT_COLUMNS[$query->sort],
            $query->direction->value
        );

        // 削除タイプ
        $this->applySoftDeleteFilter($q, $query->trashType);

        $paginater = $q->simplePaginate(
            $query->perPage,
            ['id', 'title', 'deleted_at'],
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
        return Category::query()
            ->orderBy('id')
            ->get()
            ->map(fn($model) => new CategoryRecord(
              $model->id,
              $model->title,
              $model->trashed()
            ))
            ->all();
    }
    
    /**
     * 削除ステータスに応じてクエリを修飾
     *
     * @param  Builder $q
     * @param  TrashType $trashType
     * @return void
     */
    private function applySoftDeleteFilter(Builder $q, TrashType $trashType): void
    {
        match ($trashType) {
            TrashType::All  => $q->withTrashed(),
            TrashType::Only => $q->onlyTrashed(),
            default         => null
        };
    }
}