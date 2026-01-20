<?php

namespace App\Application\Category\Assembler;

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
        private CategoryAuthorizationService $bookAuthorizationService
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
        $canUpdate = $this->bookAuthorizationService->canUpdate(
            $user
        );

        $canDelete = $this->bookAuthorizationService->canDelete(
            $user
        );

        return new CategoryView(
            $record->id,
            $record->title,
            $canUpdate,
            $canDelete,
            $record->trashed
        );
    }

    /**
     * fromRecordの配列からCategoryViewの配列を生成する
     *
     * @param  CategoryRecord[] $records
     * @param  User $user
     * @return CategoryView[]
     */
    public function buildViewsFromRecords(array $records, User $user): array {
        return array_map(function($record) use($user) {
            return $this->fromRecord(
                $record,
                $user
            );
        }, $records);
    }
}