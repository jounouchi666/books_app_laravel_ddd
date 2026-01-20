<?php

namespace App\Infrastructure\Persistence\Eloquent\DTO;

use App\Domain\Category\Entity\Category;
use App\Models\Category as ModelsCategory;
use LogicException;

/**
 * DTO
 * CategoryRecord
 */
final class CategoryRecord
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly bool $trashed
    ) {}

        
    // /**
    //  * エンティティからインスタンスを作成
    //  *
    //  * @param  Category $category
    //  * @return self
    //  */
    // public static function fromEntity(Category $category): self
    // {
    //     if (is_null($category->id())) throw new LogicException('Category must have id');

    //     return new self(
    //         $category->id()->value(),
    //         $category->title()->value()
    //     );
    // }
    
    // /**
    //  * エンティティの配列からインスタンスを作成
    //  *
    //  * @param  Category[] $Categories
    //  * @return self[]
    //  */
    // public static function fromEntities(array $categories): array
    // {
    //     return array_map(
    //         fn(Category $category) => self::fromEntity($category),  
    //         $categories
    //     );
    // }

    /**
     * モデルからインスタンスを作成
     *
     * @param  ModelsCategory $category
     * @return self
     */
    public static function fromModel(ModelsCategory $category): self
    {
        if (is_null($category->id)) throw new LogicException('Category must have id');

        return new self(
            $category->id,
            $category->title,
            $category->trashed()
        );
    }

    /**
     * モデルの配列からインスタンスを作成
     *
     * @param  ModelsCategories[] $categories
     * @return self
     */
    public static function fromModels(array $categories): array
    {
        return array_map(
            fn(ModelsCategory $category) => self::fromModel($category),  
            $categories
        );
    }
}