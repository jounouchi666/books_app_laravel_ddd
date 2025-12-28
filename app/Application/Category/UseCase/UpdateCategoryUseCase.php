<?php

namespace App\Application\Category\UseCase;

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
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }
    
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
        
        $category->changeTitle(new CategoryTitle($title));

        return $this->categoryRepository->save($category);
    }
}