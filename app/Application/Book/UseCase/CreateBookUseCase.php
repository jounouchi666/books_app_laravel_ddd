<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Book\DTO\SaveBookDto;
use App\Domain\Book\Entity\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\BookReadingStatus;
use App\Domain\Book\ValueObject\BookTitle;
use App\Domain\Shared\ValueObject\CategoryId;
use App\Domain\Shared\ValueObject\UserId;

/**
 * ユースケース
 * Book新規作成
 */
class CreateBookUseCase
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private CurrentUserProvider $currentUserProvider
    ) {}
    
    /**
     * 実行
     *
     * @param  SaveBookDto $book
     * @return Book
     */
    function execute(SaveBookDto $book): Book
    {
        $currentUser = $this->currentUserProvider->currentUser();

        $newBook = Book::create(
            new BookTitle($book->title),
            new UserId($currentUser->id()->value()),
            is_null($book->categoryId) ? null : new CategoryId($book->categoryId),
        );
        
        return $this->bookRepository->save($newBook);
    }
}