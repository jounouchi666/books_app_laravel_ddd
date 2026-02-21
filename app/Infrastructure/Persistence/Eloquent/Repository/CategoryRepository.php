<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Domain\Category\Entity\Category;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Shared\ValueObject\CategoryId;
use App\Domain\Category\ValueObject\CategoryTitle;
use App\Models\Category as ModelsCategory;

/**
 * リポジトリー
 * Category
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * 全件取得
     *
     * @return Category[]
     */
    public function findAll(): array
    {
        $categoryModels = ModelsCategory::all();
        $categories = [];
        foreach ($categoryModels as $categoryModel) {
            $categories[] = $this->modelToEntity($categoryModel);
        }
        return $categories;
    }
        
    /**
     * ID指定での取得
     *
     * @param  CategoryId $id
     * @return ?Category
     */
    public function findById(CategoryId $id): ?Category
    {
        $categoryModel = ModelsCategory::withTrashed()->find($id->value());

        if (is_null($categoryModel)) return null;
        return $this->modelToEntity($categoryModel);
    }

    /**
     * 新規保存/更新
     *
     * @param  Category $category
     * @return Category ID確定後のCategory
     */
    public function save(Category $category): Category
    {
        $id = $category->id();
        $values = [
            'title' => $category->title()->value()
        ];
        
        if (is_null($id)) {
            // 新規登録
            $newModel = ModelsCategory::create($values);
            return $this->modelToEntity($newModel);
        } else {
            // 更新
            $categoryModel = ModelsCategory::withTrashed()->findOrFail($id->value());
            $categoryModel->update($values);
            return $this->modelToEntity($categoryModel);
        }
    }
    
    /**
     * 論理削除
     *
     * @param  CategoryId $id
     * @return void
     */
    public function delete(CategoryId $id): void
    {
        ModelsCategory::findOrFail($id->value())->delete();
    }

    /**
     * 復元
     *
     * @param  CategoryId $id
     * @return void
     */
    public function restore(CategoryId $id): void
    {
        ModelsCategory::withTrashed()->findOrFail($id->value())->restore();
    }

    /**
     * 物理削除
     *
     * @param  CategoryId $id
     * @return void
     */
    public function forceDelete(CategoryId $id): void
    {
        ModelsCategory::withTrashed()->findOrFail($id->value())->forceDelete();
    }
    
    /**
     * モデルをエンティティに変換する
     *
     * @param  ModelsCategory $model
     * @return Category
     */
    private function modelToEntity(ModelsCategory $model): Category
    {
        return Category::reconstruct(
            new CategoryId($model->id),
            new CategoryTitle($model->title)
        );
    }
}