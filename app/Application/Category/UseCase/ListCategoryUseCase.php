<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Category\Assembler\CategoryViewAssembler;
use App\Application\Category\Query\ListCategoryQuery;
use App\Application\Category\Repository\CategorySearchRepositoryInterface;


/**
 * ユースケース
 * Category一覧取得
 */
class ListCategoryUseCase
{
    public function __construct(
        private CategorySearchRepositoryInterface $categoryRepository,
        private CategoryViewAssembler $categoryViewAssembler,
        private CurrentUserProvider $currentUserProvider
    ) {}
    
    /**
     * 実行
     *
     * @param  ListCategoryQuery $query
     * @return CategoryView[]
     */
    function execute(ListCategoryQuery $query): array
    {
        $currentUser = $this->currentUserProvider->currentUser();

        return array_map(function($categoryRecord) use($currentUser) {
            return $this->categoryViewAssembler->fromRecord(
                $categoryRecord,
                $currentUser
            );
        }, $this->categoryRepository->search($query));
    }
}