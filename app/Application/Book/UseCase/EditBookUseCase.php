<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\BookPermission;
use App\Domain\Book\Entity\Book;
use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\BookId;

/**
 * ユースケース
 * Book編集系用
 */
class EditBookUseCase
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private AuthorizationService $authorizationService
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @return Book
     */
    function execute(int $id): Book
    {
        $bookId = new BookId($id);
        $book = $this->bookRepository->findById($bookId);
        
        if (is_null($book)) {
            throw new BookNotFoundException($bookId);
        }

        // 認可
        $this->authorizationService->authorize(
            BookPermission::update($book)
        );

        return $book;
    }
}