<?php

namespace App\Application\Book\UseCase;

use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\BookId;

/**
 * ユースケース
 * Book削除
 */
class DeleteBookUseCase
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
     * @return void
     */
    function execute(int $id): void
    {       
        $bookId = new BookId($id);
        $book = $this->bookRepository->findById($bookId);
        
        if (is_null($book)) throw new BookNotFoundException($bookId);

        $this->bookRepository->delete($bookId);
    }
}