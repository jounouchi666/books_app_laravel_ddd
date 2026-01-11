<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Book\Assembler\BookViewAssembler;
use App\Application\Book\DTO\BookListView;
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

        $bookViews = $this->bookViewAssembler->buildViewsFromRecords(
            $this->bookRepository->search($query),
            $currentUser
        );
        
        return new BookListView(
            $bookViews,
            $this->bookAutorizationService->canCreate($currentUser),
        );
    }
}