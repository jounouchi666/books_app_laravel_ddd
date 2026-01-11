<?php

namespace App\Application\Category\DTO;

use App\Domain\Category\Entity\Category;

final class CategoryFormDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $title,
    ) {}

    public static function fromEntity(Category $category): self
    {
        return new self(
            $category->id()?->value(),
            $category->title()->value(),
        );
    }

    public static function empty(): self
    {
        return new self(null, '');
    }
}