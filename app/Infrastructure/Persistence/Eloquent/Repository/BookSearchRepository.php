<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\UI\DTO\PaginatedResult;
use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Application\Book\Query\ListBookQuery;
use App\Domain\Book\ValueObject\BookId;
use App\Infrastructure\Persistence\Eloquent\DTO\BookRecord;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * リポジトリー
 * BookSearch
 */
class BookSearchRepository implements BookSearchRepositoryInterface
{
    /**
     * 検索
     *
     * @param  ListBookQuery $query
     * @return PaginateResult
     */
    public function search(ListBookQuery $query): PaginatedResult
    {
        $q = DB::table('books');

        // 結合
        $this->withCategory($q);
        $this->selectBookViewColumns($q);

        // フィルター
        if ($query->userId) {
            $q->where('books.user_id', $query->userId);
        }
        if ($query->categoryId) {
            $q->where('books.category_id', $query->categoryId);
        }

        // ソート
        $q->orderBy($query->sortColumn(), $query->direction);

        $paginater = $q->paginate(
            $query->perPage,
            ['*'],
            'page',
            $query->page
        );

        return new PaginatedResult(
            BookRecord::fromModels($paginater->items()),
            $paginater->currentPage(),
            $paginater->lastPage(),
            $paginater->perPage(),
            $paginater->total()
        );
    }

    /**
     * 単一取得
     *
     * @param  BookId $id
     * @return BookRecord
     */
    public function getView(BookId $id): ?BookRecord
    {
        $q = DB::table('books');
        // 結合
        $this->withCategory($q);
        $this->selectBookViewColumns($q);

        $model = $q->where('books.id', $id->value())->first();

        if (is_null($model)) return null;

        return new BookRecord(
              $model->id,
              $model->title,
              $model->user_id,
              $model->category_id,
              $model->category_title ?? ''
        );
    }
    
    /**
     * Categoryと結合
     *
     * @param  Builder $q
     * @return void
     */
    private function withCategory(Builder $q): void
    {
        $q->leftJoin('categories', 'categories.id', '=', 'books.category_id');
    }
    
    /**
     * 取得カラムの指定
     *
     * @param  Builder $q
     * @return void
     */
    private function selectBookViewColumns(Builder $q): void
    {
        $q->select(
            'books.id',
            'books.title',
            'books.user_id',
            'books.category_id',
            'categories.title as category_title'
        );
    }
}