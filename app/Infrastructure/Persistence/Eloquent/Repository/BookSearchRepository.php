<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Application\Book\DTO\BookView;
use App\Application\Book\Query\ListBookQuery;
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
     * @return BookView[]
     */
    public function search(ListBookQuery $query): array
    {
        $q = DB::table('books');

        // 結合
        $q->leftJoin('categories', 'categories.id', '=', 'books.category_id')
          ->select(
            'books.id',
            'books.title',
            'books.user_id',
            'books.category_id',
            'categories.title as category_title'
        );

        // フィルター
        if ($query->userId) {
            $q->where('books.user_id', $query->userId);
        }
        if ($query->categoryId) {
            $q->where('books.category_id', $query->categoryId);
        }

        // ソート
        $q->orderBy($query->sortColumn(), $query->direction);

        return $q->get()
            ->map(fn($model) => new BookView(
              $model->id,
              $model->title,
              $model->user_id,
              $model->category_id,
              $model->category_title
            ))
            ->all();
    }
}