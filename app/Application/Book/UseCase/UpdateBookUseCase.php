<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\CurrentUserProvider;
use App\Application\Auth\Permission\BookPermission;
use App\Application\Book\DTO\SaveBookDto;
use App\Domain\Book\Entity\Book;
use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\BookId;
use App\Domain\Book\ValueObject\BookReadingStatus;
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
        private AuthorizationService $authorizationService,
        private CurrentUserProvider $currentUserProvider
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @param  SaveBookDto $book
     * @return Book
     */
    function execute(int $id, SaveBookDto $book): Book
    {
        $bookId = new BookId($id);
        $bookEntity = $this->bookRepository->findById($bookId);

        $currentUser = $this->currentUserProvider->currentUser();
        
        if (is_null($bookEntity)) throw new BookNotFoundException($bookId);
        
        // 認可
        $this->authorizationService->authorize(
            BookPermission::update($bookEntity)
        );

        $bookEntity->changeTitle(new BookTitle($book->title));
        $bookEntity->changeUser(new UserId($currentUser->id()->value()));
        $bookEntity->changeCategory(
            is_null($book->categoryId) ? null : new CategoryId($book->categoryId)
        );
        $bookEntity->changeStatus($book->readingStatus);

        return $this->bookRepository->save($bookEntity);
    }
}