<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\BookPermission;
use App\Application\Book\DTO\SaveBookReadingStatusDto;
use App\Domain\Book\Entity\Book;
use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\BookId;

/**
 * ユースケース
 * BookReadingStatus更新
 */
class ChangeBookReadingStatusUseCase
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private AuthorizationService $authorizationService,
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @param  SaveBookReadingStatusDto $book
     * @return Book
     */
    function execute(int $id, SaveBookReadingStatusDto $book): Book
    {
        $bookId = new BookId($id);
        $bookEntity = $this->bookRepository->findById($bookId);
        
        if (is_null($bookEntity)) throw new BookNotFoundException($bookId);
        
        // 認可
        $this->authorizationService->authorize(
            BookPermission::update($bookEntity)
        );

        $bookEntity->changeStatus($book->readingStatus);

        return $this->bookRepository->save($bookEntity);
    }
}