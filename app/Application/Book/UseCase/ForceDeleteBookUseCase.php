<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\CurrentUserProvider;
use App\Application\Auth\Permission\BookPermission;
use App\Application\Book\DTO\ActionBookResponse;
use App\Application\Book\DTO\BookUIQuery;
use App\Application\Book\Query\ListBookQuery;
use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\BookId;

/**
 * ユースケース
 * Book物理削除
 */
class ForceDeleteBookUseCase
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private AuthorizationService $authorizationService,
        private CurrentUserProvider $currentUserProvider
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @return ActionBookResponse
     */
    function execute(int $id, ListBookQuery $query): ActionBookResponse
    {
        $currentUser = $this->currentUserProvider->currentUser();
        $isAdmin = $currentUser->isAdmin();

        $bookId = new BookId($id);
        $book = $this->bookRepository->findById($bookId);
        
        if (is_null($book)) throw new BookNotFoundException($bookId);

        // 認可
        $this->authorizationService->authorize(
            BookPermission::forceDelete($book)
        );

        $this->bookRepository->forceDelete($bookId);

        $bookUIQuery = BookUIQuery::fromQuery($query, $isAdmin);

        return new ActionBookResponse(
            $bookUIQuery,
            '復元しました'
        );
    }
}