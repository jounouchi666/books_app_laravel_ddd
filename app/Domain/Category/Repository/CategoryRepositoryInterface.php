<?php

namespace App\Domain\Category\Repository;

use App\Domain\Shared\ValueObject\CategoryId;
use App\Domain\Category\Entity\Category;

/**
 * インターフェース
 * Category
 */
interface CategoryRepositoryInterface
{
    /**
     * 全件取得
     *
     * @return Category[]
     */
    public function findAll(): array;
        
    /**
     * ID指定での取得
     *
     * @param  CategoryId $id
     * @return ?Category
     */
    public function findById(CategoryId $id): ?Category;

    /**
     * 新規保存/更新
     *
     * @param  Category $category
     * @return Category ID確定後のCategory
     */
    public function save(Category $category): Category;
    
    /**
     * 削除
     *
     * @param  CategoryId $id
     * @return void
     */
    public function delete(CategoryId $id): void;
}