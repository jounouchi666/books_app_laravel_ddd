<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Application\Book\DTO\BookView;
use App\Application\Book\Query\ListBookQuery;
use App\Models\Book as ModelsBook;

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
        $q = ModelsBook::query();

        if ($query->userId) {
            $q->where('user_id', $query->userId);
        }

        if ($query->categoryId) {
            $q->where('category_id', $query->categoryId);
        }

        if ($query->direction === 'desc') {
            $q->latest($query->sort);
        } else {
            $q->oldest($query->sort);
        }

        return $q->get()
            ->map(fn($model) => new BookView(
              $model->id,
              $model->title,
              $model->user_id,
              $model->category_id
            ))
            ->all();
    }
}