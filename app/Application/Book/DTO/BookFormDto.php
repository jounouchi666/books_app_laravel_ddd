<?php

namespace App\Application\Book\DTO;

use App\Domain\Book\Entity\Book;

final class BookFormDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $title,
        public readonly ?int $categoryId,
    ) {}

    public static function fromEntity(Book $book): self
    {
        return new self(
            $book->id()?->value(),
            $book->title()->value(),
            $book->categoryId()?->value()
        );
    }

    public static function empty(): self
    {
        return new self(null, '', null);
    }
}