<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Category\Assembler\CategoryViewAssembler;
use App\Application\Category\DTO\CategoryListView;
use App\Application\Category\Query\ListCategoryQuery;
use App\Application\Category\Repository\CategorySearchRepositoryInterface;
use App\Application\Category\Service\CategoryAuthorizationService;

/**
 * ユースケース
 * Category一覧取得
 */
class ListCategoryUseCase
{
    public function __construct(
        private CategoryAuthorizationService $categoryAuthorizationService,
        private CategorySearchRepositoryInterface $categoryRepository,
        private CategoryViewAssembler $categoryViewAssembler,
        private CurrentUserProvider $currentUserProvider
    ) {}
    
    /**
     * 実行
     *
     * @param  ListCategoryQuery $query
     * @return CategoryListView
     */
    public function execute(ListCategoryQuery $query): CategoryListView
    {
        $currentUser = $this->currentUserProvider->currentUser();

        $categoryViews = $this->categoryViewAssembler->buildViewsFromRecords(
            $this->categoryRepository->search($query),
            $currentUser
        );

        return new CategoryListView(
            $categoryViews,
            $this->categoryAuthorizationService->canCreate($currentUser)
        );
    }
}