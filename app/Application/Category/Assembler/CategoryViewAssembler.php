<?php

namespace App\Application\Category\Assembler;

use App\Application\Category\DTO\CategoryActionType;
use App\Application\Category\DTO\CategoryView;
use App\Application\Category\Service\CategoryAuthorizationService;
use App\Domain\User\Entity\User;
use App\Infrastructure\Persistence\Eloquent\DTO\CategoryRecord;

/**
 * CategoryViewAssembler
 * 
 * CategoryViewを生成する
 */
final class CategoryViewAssembler
{
    public function __construct(
        private CategoryAuthorizationService $categoryAuthorizationService
    ) {}

    /**
     * fromRecordからCategoryViewを生成する
     *
     * @param  CategoryRecord $record
     * @param  User $user
     * @return CategoryView
     */
    public function fromRecord(CategoryRecord $record, User $user): CategoryView
    {
        $canUpdate = $this->categoryAuthorizationService->canUpdate(
            $user
        );

        $canDelete = $this->categoryAuthorizationService->canDelete(
            $user
        );

        $canRestore = $this->categoryAuthorizationService->canRestore(
            $user
        );

        $canForceDelete = $this->categoryAuthorizationService->canForceDelete(
            $user
        );

        $trashed = $record->trashed;

        return new CategoryView(
            $record->id,
            $record->title,
            $canUpdate,
            $canDelete,
            $canRestore,
            $canForceDelete,
            $trashed,
            $this->judgeActionType($trashed, $canDelete, $canRestore)
        );
    }

    /**
     * fromRecordの配列からCategoryViewの配列を生成する
     *
     * @param  CategoryRecord[] $records
     * @param  User $user
     * @return CategoryView[]
     */
    public function buildViewsFromRecords(array $records, User $user): array
    {
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
     * @return CategoryActionType
     */
    private function judgeActionType(bool $trashed, bool $canDelete, bool $canRestore): CategoryActionType
    {
        $type = CategoryActionType::None;

        if (!$trashed && $canDelete) {
            $type = CategoryActionType::Delete;
        }
        
        if ($trashed && $canRestore) {
            $type = CategoryActionType::Restore;
        }

        return $type;
    }
}