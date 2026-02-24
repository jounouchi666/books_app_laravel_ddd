<?php

namespace App\Infrastructure\Persistence\Eloquent\DTO;

use App\Domain\Book\Entity\Book;
use App\Domain\Book\ValueObject\BookReadingStatus;
use App\Models\Book as ModelsBook;
use LogicException;

/**
 * DTO
 * BookRecord
 */
final class BookRecord
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $userId,
        public readonly string $userName,
        public readonly ?int $categoryId,
        public readonly string $categoryTitle,
        public readonly BookReadingStatus $readingStatus,
        public readonly bool $trashed
    ) {}

        
    // /**
    //  * エンティティからインスタンスを作成
    //  * リレーション先の情報を持たないため、$catagoryTitleは''(空文字)
    //  *
    //  * @param  Book $book
    //  * @return self
    //  */
    // public static function fromEntity(Book $book): self
    // {
    //     if (is_null($book->id())) throw new LogicException('Book must have id');

    //     return new self(
    //         $book->id()->value(),
    //         $book->title()->value(),
    //         $book->userId()->value(),
    //         is_null($book->categoryId())
    //             ? null
    //             : $book->categoryId()->value(),
    //         '',
    //     );
    // }
    
    // /**
    //  * エンティティの配列からインスタンスを作成
    //  *
    //  * @param  Book[] $books
    //  * @return self[]
    //  */
    // public static function fromEntities(array $books): array
    // {
    //     return array_map(
    //         fn(Book $book) => self::fromEntity($book),  
    //         $books
    //     );
    // }
  
    /**
     * モデルからインスタンスを作成
     *
     * @param  ModelsBook $book
     * @return self
     */
    public static function fromModel(ModelsBook $book): self
    {
        if (is_null($book->id)) throw new LogicException('Book must have id');

        return new self(
            $book->id,
            $book->title,
            $book->user_id,
            $book->user_name,
            is_null($book->category_id)
                ? null
                : $book->category_id,
            $book->category_title ?? '',
            $book->reading_status,
            $book->trashed()
        );
    }

    /**
     * モデルの配列からインスタンスを作成
     *
     * @param  ModelsBook[] $books
     * @return self
     */
    public static function fromModels(array $books): array
    {
        return array_map(
            fn(ModelsBook $book) => self::fromModel($book),  
            $books
        );
    }
}