<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\CategoryPermission;
use App\Application\Category\DTO\SaveCategoryDto;
use App\Domain\Category\Entity\Category;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Category\ValueObject\CategoryTitle;

/**
 * ユースケース
 * Category新規作成
 */
class CreateCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private AuthorizationService $AuthorizationService
    ) {}
    
    /**
     * 実行
     *
     * @param  SaveCategoryDto $category
     * @return Category
     */
    function execute(SaveCategoryDto $category): Category
    {
        // 認可
        $this->AuthorizationService->authorize(
            CategoryPermission::create()
        );

        $newCategory = Category::create(
            new CategoryTitle($category->title)
        );
        
        return $this->categoryRepository->save($newCategory);
    }
}