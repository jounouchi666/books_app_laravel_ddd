<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\BookPermission;
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
        private AuthorizationService $authorizationService
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @return void
     */
    function execute(int $id): void
    {       
        $bookId = new BookId($id);
        $book = $this->bookRepository->findById($bookId);
        
        if (is_null($book)) throw new BookNotFoundException($bookId);

        // 認可
        $this->authorizationService->authorize(
            BookPermission::delete($book)
        );

        $this->bookRepository->forceDelete($bookId);
    }
}