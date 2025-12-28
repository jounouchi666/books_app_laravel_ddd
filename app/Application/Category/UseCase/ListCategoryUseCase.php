<?php

namespace App\Application\Category\UseCase;

use App\Application\Category\Query\ListCategoryQuery;
use App\Application\Category\Repository\CategorySearchRepositoryInterface;


/**
 * ユースケース
 * Category一覧取得
 */
class ListCategoryUseCase
{
    private CategorySearchRepositoryInterface $categoryRepository;

    public function __construct(CategorySearchRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * 実行
     *
     * @param  ListCategoryQuery $query
     * @return CategoryView[]
     */
    function execute(ListCategoryQuery $query): array
    {
        return $this->categoryRepository->search($query);
    }
}