<?php

namespace App\Application\Book\Repository;

use App\Application\UI\DTO\PaginatedResult;
use App\Application\Book\Query\ListBookQuery;
use App\Domain\Book\ValueObject\BookId;
use App\Infrastructure\Persistence\Eloquent\DTO\BookRecord;

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
     * @return PaginateResult
     */
    public function search(ListBookQuery $query): PaginatedResult;
    
    /**
     * 単一取得
     *
     * @param  BookId $id
     * @return BookRecord
     */
    public function getView(BookId $id): ?BookRecord;
}