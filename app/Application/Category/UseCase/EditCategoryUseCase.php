<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\CategoryPermission;
use App\Application\Category\DTO\CategoryFormDto;
use App\Domain\Category\Entity\Category;
use App\Domain\Category\Exception\CategoryNotFoundException;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Shared\ValueObject\CategoryId;

/**
 * ユースケース
 * Category編集系用
 */
class EditCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private AuthorizationService $authorizationService
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @return CategoryFormDto
     */
    function execute(int $id): CategoryFormDto
    {
        $categoryId = new CategoryId($id);
        $category = $this->categoryRepository->findById($categoryId);

        if (is_null($category)) {
            throw new CategoryNotFoundException($categoryId);
        }

        // 認可
        $this->authorizationService->authorize(
            CategoryPermission::update($category)
        );

        return CategoryFormDto::fromEntity($category);
    }
}