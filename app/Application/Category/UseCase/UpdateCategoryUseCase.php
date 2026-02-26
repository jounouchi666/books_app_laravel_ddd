<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\CategoryPermission;
use App\Application\Category\DTO\SaveCategoryDto;
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
     * @param  SaveCategoryDto $category
     * @return Category
     */
    function execute(int $id, SaveCategoryDto $category): Category
    {
        $CategoryId = new CategoryId($id);
        $categorEntity = $this->categoryRepository->findById($CategoryId);

        if (is_null($categorEntity)) throw new CategoryNotFoundException($CategoryId);
        
        // 認可
        $this->AuthorizationService->authorize(
            CategoryPermission::update($categorEntity)
        );

        $categorEntity->changeTitle(new CategoryTitle($category->title));

        return $this->categoryRepository->save($categorEntity);
    }
}