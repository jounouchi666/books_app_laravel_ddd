<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Domain\Book\Entity\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\BookId;
use App\Domain\Book\ValueObject\BookTitle;
use App\Domain\Shared\ValueObject\CategoryId;
use App\Domain\Shared\ValueObject\UserId;
use App\Models\Book as ModelsBook;

/**
 * リポジトリー
 * Book
 */
class BookRepository implements BookRepositoryInterface
{
    /**
     * 全件取得
     *
     * @return Book[]
     */
    public function findAll(): array
    {
        $bookModels = ModelsBook::all();
        $books = [];
        foreach ($bookModels as $bookModel) {
            $books[] = $this->modelToEntity($bookModel);
        }
        return $books;
    }
        
    /**
     * ID指定での取得
     *
     * @param  BookId $id
     * @return ?Book
     */
    public function findById(BookId $id): ?Book
    {
        $bookModel = ModelsBook::find($id->value());

        if (is_null($bookModel)) return null;
        return $this->modelToEntity($bookModel);
    }

    /**
     * 新規保存/更新
     *
     * @param  Book $book
     * @return Book ID確定後のBook
     */
    public function save(Book $book): Book
    {
        $id = $book->id();
        $values = [
            'title'       => $book->title()->value(),
            'user_id'     => $book->userId()->value(),
            'category_id' => is_null($book->categoryId())
                ? null
                : $book->categoryId()->value(),
        ];
        
        if (is_null($id)) {
            // 新規登録
            $newModel = ModelsBook::create($values);
            return $this->modelToEntity($newModel);
        } else {
            // 更新
            $bookModel = ModelsBook::findOrFail($id->value());
            $bookModel->update($values);
            return $this->modelToEntity($bookModel);
        }
    }
    
    /**
     * 削除
     *
     * @param  BookId $id
     * @return void
     */
    public function delete(BookId $id): void
    {
        ModelsBook::destroy($id->value());
    }
    
    /**
     * モデルをエンティティに変換する
     *
     * @param  ModelsBook $model
     * @return Book
     */
    private function modelToEntity(ModelsBook $model): Book
    {
        return Book::reconstruct(
            new BookId($model->id),
            new BookTitle($model->title),
            new UserId($model->user_id),
            is_null($model->category_id) 
                ? null
                : new CategoryId($model->category_id),
        );
    }
}