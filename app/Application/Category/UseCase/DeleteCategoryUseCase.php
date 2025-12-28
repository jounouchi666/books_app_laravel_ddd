<?php

namespace App\Application\Category\UseCase;

use App\Domain\Category\Exception\CategoryNotFoundException;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Shared\ValueObject\CategoryId;

/**
 * ユースケース
 * Category削除
 */
class DeleteCategoryUseCase
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
     * @return void
     */
    function execute(int $id): void
    {       
        $CategoryId = new CategoryId($id);
        $category = $this->categoryRepository->findById($CategoryId);
        
        if (is_null($category)) throw new CategoryNotFoundException($CategoryId);

        $this->categoryRepository->delete($CategoryId);
    }
}