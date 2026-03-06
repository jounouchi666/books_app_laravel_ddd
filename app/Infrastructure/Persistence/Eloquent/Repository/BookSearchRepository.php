<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\UI\DTO\PaginatedResult;
use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Application\Book\Query\ListBookQuery;
use App\Application\Shared\Enum\TrashType;
use App\Domain\Book\ValueObject\BookId;
use App\Infrastructure\Persistence\Eloquent\DTO\BookRecord;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

/**
 * リポジトリー
 * BookSearch
 */
class BookSearchRepository implements BookSearchRepositoryInterface
{
    private const SORT_COLUMNS = [
        'title'       => 'books.title',
        'user_id'     => 'books.user_id',
        'category_id' => 'books.category_id',
        'created_at'  => 'books.created_at'
    ];

    /**
     * 検索
     *
     * @param  ListBookQuery $query
     * @return PaginateResult
     */
    public function search(ListBookQuery $query): PaginatedResult
    {
        $q = Book::query();

        // 結合
        $this->withUser($q);
        $this->withCategory($q);
        $this->selectBookViewColumns($q);

        // フィルター
        if (!is_null($query->userId)) {
            $q->where('books.user_id', $query->userId);
        }
        if ($query->categoryId) {
            $q->where('books.category_id', $query->categoryId);
        }

        if (!is_null($query->readingStatus)) {
            $q->where('reading_status', $query->readingStatus->value);
        }

        // ソート
        $q->orderBy(
            self::SORT_COLUMNS[$query->sort],
            $query->direction->value
        );

        // 削除タイプ
        $this->applySoftDeleteFilter($q, $query->trashType);

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
            $paginater->total(),
            $paginater->onFirstPage(),
            $paginater->onLastPage(),
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
        $q = Book::query();;
        // 結合
        $this->withUser($q);
        $this->withCategory($q);
        $this->selectBookViewColumns($q);

        $model = $q->where('books.id', $id->value())->first();

        if (is_null($model)) return null;

        return BookRecord::fromModel($model);
    }

    /**
     * Userと結合
     *
     * @param  Builder $q
     * @return void
     */
    private function withUser(Builder $q): void
    {
        $q->leftJoin('users', 'users.id', '=', 'books.user_id');
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
            'users.name as user_name',
            'books.category_id',
            'categories.title as category_title',
            'books.reading_status',
            'books.updated_at',
            'books.created_at',
            'books.deleted_at',
            'categories.deleted_at as category_deleted_at'
        );
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