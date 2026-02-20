<?php

namespace App\Application\Category\UseCase;

use App\Application\Auth\AuthorizationService;
use App\Application\Auth\Permission\CategoryPermission;
use App\Application\Category\DTO\ActionCategoryResponse;
use App\Application\Category\DTO\CategoryUIQuery;
use App\Application\Category\Query\ListCategoryQuery;
use App\Domain\Category\Exception\CategoryNotFoundException;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Shared\ValueObject\CategoryId;

/**
 * ユースケース
 * Category物理削除
 */
class ForceDeleteCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private AuthorizationService $AuthorizationService
    ) {}
    
    /**
     * 実行
     *
     * @param  int $id
     * @return ActionCategoryResponse
     */
    function execute(int $id, ListCategoryQuery $query): ActionCategoryResponse
    {
        $CategoryId = new CategoryId($id);
        $category = $this->categoryRepository->findById($CategoryId);
        
        if (is_null($category)) throw new CategoryNotFoundException($CategoryId);

        // 認可
        $this->AuthorizationService->authorize(
            CategoryPermission::forceDelete($category)
        );

        $this->categoryRepository->forceDelete($CategoryId);

        // URL用パラメータ
        $categoryUIQuery = CategoryUIQuery::fromQuery($query);

        return new ActionCategoryResponse(
            $categoryUIQuery,
            '削除しました'
        );
    }
}