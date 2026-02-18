<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Category\Assembler\CategoryViewAssembler;
use App\Application\Category\DTO\CategoryListView;
use App\Application\Category\DTO\CategoryUIQuery;
use App\Application\Category\Query\ListCategoryQuery;
use App\Application\Category\Repository\CategorySearchRepositoryInterface;
use App\Application\Category\Service\CategoryAuthorizationService;
use App\Application\UI\DTO\SimplePaginateView;
use App\Application\UI\SimplePaginationUrlGeneratorFactory;

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
        private CurrentUserProvider $currentUserProvider,
        private SimplePaginationUrlGeneratorFactory $simplePaginationUrlGeneratorFactory
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

        // 取得
        $result = $this->categoryRepository->search($query);

        $categoryViews = $this->categoryViewAssembler->buildViewsFromRecords(
            $result->records,
            $currentUser
        );

        // URL用パラメータ
        $categoryUIQuery = CategoryUIQuery::fromQuery($query);

        // ページネーション
        $simplePaginateView = new SimplePaginateView(
            $result->hasNext,
            $result->hasPrev,
            $this->simplePaginationUrlGeneratorFactory->create(
                $categoryUIQuery->toQueryArray(),
                $result->currentPage,
                $result->hasNext
            )
        );

        return new CategoryListView(
            $categoryViews,
            $this->categoryAuthorizationService->canCreate($currentUser),
            $simplePaginateView,
            $categoryUIQuery
        );
    }
}