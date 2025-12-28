<?php

namespace App\Application\Category\UseCase;

use App\Domain\Category\Entity\Category;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Shared\ValueObject\CategoryId;

/**
 * ユースケース
 * Category編集系用
 */
class EditCategoryUseCase
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * 実行
     *
     * @param  int $id
     * @return ?Category
     */
    function execute(int $id): ?Category
    {
        $categoryId = new CategoryId($id);
        return $this->categoryRepository->findById($categoryId);
    }
}