<?php

namespace App\Application\Category\UseCase;

use App\Application\Category\Assembler\CategorySelectAssembler;
use App\Application\Category\DTO\CategorySelectView;
use App\Application\Category\Repository\CategorySearchRepositoryInterface;

/**
 * ユースケース
 * Category一覧取得
 */
class ListSelectableCategoryUseCase
{
    public function __construct(
        private CategorySearchRepositoryInterface $categoryRepository,
        private CategorySelectAssembler $categorySelectAssembler,
    ) {}
    
    /**
     * 実行
     *
     * @return CategorySelectView[]
     */
    public function execute(): array
    {
        return $this->categorySelectAssembler->buildViewsFromRecords(
            $this->categoryRepository->all(),
        );
    }
}