<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Book\Assembler\BookViewAssembler;
use App\Application\Book\Query\ListBookQuery;
use App\Application\Book\Repository\BookSearchRepositoryInterface;


/**
 * ユースケース
 * Book一覧取得
 */
class ListBookUseCase
{
    public function __construct(
        private BookSearchRepositoryInterface $bookRepository,
        private BookViewAssembler $bookViewAssembler,
        private CurrentUserProvider $currentUserProvider
    ) {}
    
    /**
     * 実行
     *
     * @param  ListBookQuery $query
     * @return BookView[]
     */
    function execute(ListBookQuery $query): array
    {
        $currentUser = $this->currentUserProvider->currentUser();

        return array_map(function($bookRecord) use($currentUser) {
            return $this->bookViewAssembler->fromRecord(
                $bookRecord,
                $currentUser
            );
        }, $this->bookRepository->search($query));
    }
}