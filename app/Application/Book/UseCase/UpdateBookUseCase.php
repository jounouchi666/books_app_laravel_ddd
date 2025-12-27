<?php

namespace App\Application\Book\UseCase;

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
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository) 
    {
        $this->bookRepository = $bookRepository;
    }
    
    /**
     * 実行
     *
     * @param  int $id
     * @param  string $title
     * @param  int $userId
     * @param  int $categoryId
     * @return Book
     */
    function execute(int $id, string $title, int $userId, int $categoryId): Book
    {
        $bookId = new BookId($id);
        $book = $this->bookRepository->findById($bookId);
        
        if (is_null($book)) throw new BookNotFoundException($bookId);
        
        $book->changeTitle(new BookTitle($title));
        $book->changeUser(new UserId($userId));
        $book->changeCategory(new CategoryId($categoryId));

        return $this->bookRepository->save($book);
    }
}