<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\CategoryPermission;
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
     * @param  string $title
     * @return Category
     */
    function execute(string $title): Category
    {
        // 認可
        $this->AuthorizationService->authorize(
            CategoryPermission::create()
        );

        $category = Category::create(
            new CategoryTitle($title)
        );
        
        return $this->categoryRepository->save($category);
    }
}