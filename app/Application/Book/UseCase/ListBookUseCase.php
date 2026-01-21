<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Book\Assembler\BookViewAssembler;
use App\Application\Book\DTO\BookListView;
use App\Application\Book\DTO\BookUIQuery;
use App\Application\Book\Query\ListBookQuery;
use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Application\Book\Service\BookAuthorizationService;

/**
 * ユースケース
 * Book一覧取得
 */
class ListBookUseCase
{
    public function __construct(
        private BookAuthorizationService $bookAutorizationService,
        private BookSearchRepositoryInterface $bookRepository,
        private BookViewAssembler $bookViewAssembler,
        private CurrentUserProvider $currentUserProvider
    ) {}
    
    /**
     * 実行
     *
     * @param  ListBookQuery $query
     * @return BookListView
     */
    function execute(ListBookQuery $query): BookListView
    {
        $currentUser = $this->currentUserProvider->currentUser();

        $result = $this->bookRepository->search($query);

        $bookViews = $this->bookViewAssembler->buildViewsFromRecords(
            $result->records,
            $currentUser
        );

        $bookUIQuery = new BookUIQuery(
            $query->sort,
            $query->direction,
            $query->trashType
        );
        
        return new BookListView(
            $bookViews,
            $result->currentPage,
            $result->lastPage,
            $result->perPage,
            $result->total,
            $this->bookAutorizationService->canCreate($currentUser),
            $bookUIQuery
        );
    }
}