<?php

namespace App\Application\Auth\Permission;

use App\Domain\Category\Entity\Category;

/**
 * Category用Permission定義
 * 
 * Laravel Policy に渡す ability / subject を
 * 明示的なファクトリメソッドとして提供する
 */
final class CategoryPermission extends Permission
{
    private function __construct(
        string $ability,
        string|Category $subject
    ) {
        parent::__construct($ability, $subject);
    }

        
    /**
     * 作成権限
     *
     * @return self
     */
    public static function create(): self
    {
        return new self('create', Category::class);
    }
    
    /**
     * 更新権限
     *
     * @param  Category $category
     * @return self
     */
    public static function update(Category $category): self
    {
        return new self('update', $category);
    }
    
    /**
     * 削除
     *
     * @param  Category $category
     * @return self
     */
    public static function delete(Category $category): self
    {
        return new self('delete', $category);
    }
}