<?php

namespace App\Application\Book\UseCase;

use App\Domain\Book\Entity\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\BookTitle;
use App\Domain\Shared\ValueObject\CategoryId;
use App\Domain\Shared\ValueObject\UserId;

/**
 * ユースケース
 * Book新規作成
 */
class CreateBookUseCase
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository) 
    {
        $this->bookRepository = $bookRepository;
    }
    
    /**
     * 実行
     *
     * @param  string $title
     * @param  int $userId
     * @param  int $categoryId
     * @return Book
     */
    function execute(string $title, int $userId, int $categoryId): Book
    {
        $book = Book::create(
            new BookTitle($title),
            new UserId($userId),
            new CategoryId($categoryId)
        );
        
        return $this->bookRepository->save($book);
    }
}