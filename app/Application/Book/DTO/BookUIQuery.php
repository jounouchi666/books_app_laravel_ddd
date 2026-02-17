<?php

namespace App\Application\Book\DTO;

use App\Application\Book\Query\ListBookQuery;
use App\Application\UI\Query\UIQuery;

/**
 * DTO
 * BookUIQuery
 * 
 * クエリパラメータ用
 */
final class BookUIQuery extends UIQuery
{   
    /**
     * ListBookQueryから生成
     *
     * @param  ListBookQuery $query
     * @param  bool $isAdmin
     * @return self
     */
    public static function fromQuery(ListBookQuery $query, bool $isAdmin): self
    {
        return new self(
            $isAdmin,
            $isAdmin ? $query->userId : null,
            $query->allUsers,
            $query->sort,
            $query->direction,
            $isAdmin ? $query->trashType : null
        );
    }
}