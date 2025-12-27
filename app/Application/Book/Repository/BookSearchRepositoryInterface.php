<?php

namespace App\Application\Book\Repository;

use App\Application\Book\DTO\BookView;
use App\Application\Book\Query\ListBookQuery;
use App\Domain\Book\ValueObject\BookId;

/**
 * インターフェース
 * SearchBook
 * ドメイン層のBookとは分離
 */
interface BookSearchRepositoryInterface
{
    /**
     * 検索
     *
     * @param  ListBookQuery $query
     * @return BookView[]
     */
    public function search(ListBookQuery $query): array;
    
    /**
     * 単一取得
     *
     * @param  BookId $id
     * @return BookView
     */
    public function getView(BookId $id): ?BookView;
}