<?php

namespace App\Application\Book\Repository;

use App\Application\Book\Query\ListBookQuery;

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
}