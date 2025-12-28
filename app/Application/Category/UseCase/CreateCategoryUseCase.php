<?php

namespace App\Application\Category\UseCase;

use App\Domain\Category\Entity\Category;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Category\ValueObject\CategoryTitle;

/**
 * ユースケース
 * Category新規作成
 */
class CreateCategoryUseCase
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * 実行
     *
     * @param  string $title
     * @return Category
     */
    function execute(string $title): Category
    {
        $category = Category::create(
            new CategoryTitle($title)
        );
        
        return $this->categoryRepository->save($category);
    }
}