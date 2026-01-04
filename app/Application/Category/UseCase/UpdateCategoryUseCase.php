<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\CategoryPermission;
use App\Domain\Category\Entity\Category;
use App\Domain\Category\Exception\CategoryNotFoundException;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Category\ValueObject\CategoryTitle;
use App\Domain\Shared\ValueObject\CategoryId;
use App\Domain\Shared\ValueObject\UserId;

/**
 * ユースケース
 * Category更新
 */
class UpdateCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private AuthorizationService $AuthorizationService
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @param  string $title
     * @return Category
     */
    function execute(int $id, string $title): Category
    {
        $CategoryId = new CategoryId($id);
        $category = $this->categoryRepository->findById($CategoryId);

        if (is_null($category)) throw new CategoryNotFoundException($CategoryId);
        
        // 認可
        $this->AuthorizationService->authorize(
            CategoryPermission::update($category)
        );

        $category->changeTitle(new CategoryTitle($title));

        return $this->categoryRepository->save($category);
    }
}