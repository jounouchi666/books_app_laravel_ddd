<?php

namespace App\Application\Book\DTO;

/**
 * DTO
 * BookView
 * 
 * 原則Assemblerから作成する
 */
final class BookView
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $userId,
        public readonly ?int $categoryId,
        public readonly string $categoryTitle,
        public readonly bool $canUpdate,
        public readonly bool $canDelete
    ) {}
}