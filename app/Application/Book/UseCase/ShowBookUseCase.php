<?php

namespace App\Application\Book\UseCase;

use App\Application\Book\DTO\BookView;
use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Domain\Book\ValueObject\BookId;

/**
 * ユースケース
 * Book詳細表示
 */
class ShowBookUseCase
{
    private BookSearchRepositoryInterface $bookRepository;

    public function __construct(BookSearchRepositoryInterface $bookRepository) 
    {
        $this->bookRepository = $bookRepository;
    }
    
    /**
     * 実行
     *
     * @param  int $id
     * @return ?BookView
     */
    function execute(int $id): ?BookView
    {
        $bookId = new BookId($id);
        return $this->bookRepository->getView($bookId);
    }
}