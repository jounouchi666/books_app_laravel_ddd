<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\CategoryPermission;
use App\Domain\Category\Exception\CategoryNotFoundException;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Shared\ValueObject\CategoryId;

/**
 * ユースケース
 * Category物理削除
 */
class ForceDeleteCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private AuthorizationService $AuthorizationService
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @return void
     */
    function execute(int $id): void
    {
        $CategoryId = new CategoryId($id);
        $category = $this->categoryRepository->findById($CategoryId);
        
        if (is_null($category)) throw new CategoryNotFoundException($CategoryId);

        // 認可
        $this->AuthorizationService->authorize(
            CategoryPermission::delete($category)
        );

        $this->categoryRepository->forceDelete($CategoryId);
    }
}