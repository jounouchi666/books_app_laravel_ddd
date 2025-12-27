<?php

namespace App\Application\Book\DTO;

use App\Domain\Book\Entity\Book;
use LogicException;

/**
 * DTO
 * BookView
 */
final class BookView
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $userId,
        public readonly int $categoryId,
        public readonly string $categoryTitle
    ) {}

        
    /**
     * エンティティからインスタンスを作成
     * リレーション先の情報を持たないため、$catagoryTitleは''(空文字)
     *
     * @param  Book $book
     * @return self
     */
    public static function fromEntity(Book $book): self
    {
        if (is_null($book->id())) throw new LogicException('Book must have id');

        return new self(
            $book->id()->value(),
            $book->title()->value(),
            $book->userId()->value(),
            $book->categoryId()->value(),
            '',
        );
    }
    
    /**
     * エンティティの配列からインスタンスを作成
     *
     * @param  Book[] $books
     * @return self[]
     */
    public static function fromEntities(array $books): array
    {
        return array_map(
            fn(Book $book) => self::fromEntity($book),  
            $books
        );
    }
}