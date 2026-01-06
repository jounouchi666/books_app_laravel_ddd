<?php

namespace App\Application\Book\Assembler;

use App\Application\Book\DTO\BookView;
use App\Application\Book\Service\BookAuthorizationService;
use App\Domain\Shared\ValueObject\UserId;
use App\Domain\User\Entity\User;
use App\Infrastructure\Persistence\Eloquent\DTO\BookRecord;

/**
 * BookViewAssembler
 * 
 * BookViewを生成する
 */
final class BookViewAssembler
{
    public function __construct(
        private BookAuthorizationService $bookAuthorizationService
    ) {}
    /**
     * fromRecordからBookViewを生成する
     *
     * @param  BookRecord $record
     * @param  User $currentUser
     * @return BookView
     */
    public function fromRecord(BookRecord $record, User $currentUser): BookView
    {
        $canUpdate = $this->bookAuthorizationService->canUpdate(
            new UserId($record->userId),
            $currentUser
        );

        $canDelete = $this->bookAuthorizationService->canDelete(
            new UserId($record->userId),
            $currentUser
        );

        return new BookView(
            $record->id,
            $record->title,
            $record->userId,
            $record->categoryId,
            $record->categoryTitle,
            $canUpdate,
            $canDelete
        );
    }
}