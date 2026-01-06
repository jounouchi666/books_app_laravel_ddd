<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Book\Assembler\BookViewAssembler;
use App\Application\Book\DTO\BookView;
use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\ValueObject\BookId;

/**
 * ユースケース
 * Book詳細表示
 */
class ShowBookUseCase
{
    public function __construct(
        private BookSearchRepositoryInterface $bookRepository,
        private BookViewAssembler $bookViewAssembler,
        private CurrentUserProvider $currentUserProvider
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @return BookView
     */
    function execute(int $id): BookView
    {
        $bookId = new BookId($id);
        $book = $this->bookRepository->getView($bookId);

        if (is_null($book)) throw new BookNotFoundException($bookId);

        return $this->bookViewAssembler->fromRecord(
            $book,
            $this->currentUserProvider->currentUser()
        );
    }
}