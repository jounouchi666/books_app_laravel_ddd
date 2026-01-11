<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\BookPermission;
use App\Domain\Book\Entity\Book;
use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\BookId;
use App\Domain\Book\ValueObject\BookTitle;
use App\Domain\Shared\ValueObject\CategoryId;
use App\Domain\Shared\ValueObject\UserId;

/**
 * ユースケース
 * Book更新
 */
class UpdateBookUseCase
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private AuthorizationService $authorizationService
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @param  string $title
     * @param  int $userId
     * @param  int $categoryId
     * @return Book
     */
    function execute(int $id, string $title, int $userId, ?int $categoryId): Book
    {
        $bookId = new BookId($id);
        $book = $this->bookRepository->findById($bookId);
        
        if (is_null($book)) throw new BookNotFoundException($bookId);
        
        // 認可
        $this->authorizationService->authorize(
            BookPermission::update($book)
        );

        $book->changeTitle(new BookTitle($title));
        $book->changeUser(new UserId($userId));
        $book->changeCategory(
            is_null($categoryId) ? null : new CategoryId($categoryId)
        );

        return $this->bookRepository->save($book);
    }
}