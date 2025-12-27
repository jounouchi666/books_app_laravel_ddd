<?php

namespace App\Application\Book\UseCase;

use App\Application\Book\Query\ListBookQuery;
use App\Application\Book\Repository\BookSearchRepositoryInterface;


/**
 * ユースケース
 * Book一覧取得
 */
class ListBookUseCase
{
    private BookSearchRepositoryInterface $bookRepository;

    public function __construct(BookSearchRepositoryInterface $bookRepository) 
    {
        $this->bookRepository = $bookRepository;
    }
    
    /**
     * 実行
     *
     * @param  ListBookQuery $query
     * @return BookView[]
     */
    function execute(ListBookQuery $query): array
    {
        return $this->bookRepository->search($query);
    }
}