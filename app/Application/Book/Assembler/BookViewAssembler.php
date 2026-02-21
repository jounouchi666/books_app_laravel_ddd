<?php

namespace App\Application\Book\Assembler;

use App\Application\Book\DTO\BookView;
use App\Application\Book\Service\BookAuthorizationService;
use App\Application\UI\DTO\TrashActionType;
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
    public function fromRecord(BookRecord $record, User $user): BookView
    {
        $canUpdate = $this->bookAuthorizationService->canUpdate(
            new UserId($record->userId),
            $user
        );

        $canDelete = $this->bookAuthorizationService->canDelete(
            new UserId($record->userId),
            $user
        );

        $canRestore = $this->bookAuthorizationService->canRestore(
            new UserId($record->userId),
            $user
        );

        $canForceDelete = $this->bookAuthorizationService->canForceDelete(
            new UserId($record->userId),
            $user
        );

        $trashed = $record->trashed;

        return new BookView(
            $record->id,
            $record->title,
            $record->userId,
            $record->userName,
            $record->categoryId,
            $record->categoryTitle,
            $canUpdate,
            $canDelete,
            $canRestore,
            $canForceDelete,
            $record->trashed,
            $this->judgeActionType($trashed, $canDelete, $canRestore)
        );
    }

    /**
     * fromRecordの配列からBookViewの配列を生成する
     *
     * @param  BookRecord[] $records
     * @param  User $user
     * @return BookView[]
     */
    public function buildViewsFromRecords(array $records, User $user): array {
        return array_map(function($record) use($user) {
            return $this->fromRecord(
                $record,
                $user
            );
        }, $records);
    }

    /**
     * 操作タイプの判別
     *
     * @param  bool $trashed
     * @param  bool $canDelete
     * @param  bool $canRestore
     * @return TrashActionType
     */
    private function judgeActionType(bool $trashed, bool $canDelete, bool $canRestore): TrashActionType
    {
        $type = TrashActionType::None;

        if (!$trashed && $canDelete) {
            $type = TrashActionType::Delete;
        }
        
        if ($trashed && $canRestore) {
            $type = TrashActionType::Restore;
        }

        return $type;
    }
}