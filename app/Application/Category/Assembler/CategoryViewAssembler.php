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
     * @param  User $currentUser
     * @return CategoryView
     */
    public function fromRecord(CategoryRecord $record, User $currentUser): CategoryView
    {
        $canUpdate = $this->bookAuthorizationService->canUpdate(
            $currentUser
        );

        $canDelete = $this->bookAuthorizationService->canDelete(
            $currentUser
        );

        return new CategoryView(
            $record->id,
            $record->title,
            $canUpdate,
            $canDelete
        );
    }
}