<?php

namespace App\Application\Book\DTO;

use App\Domain\Book\ValueObject\BookReadingStatus;

/**
 * DTO
 * 保存フォーム用
 */
class SaveBookDto
{
    public function __construct(
        public readonly string $title,
        public readonly ?int $categoryId,
        public readonly ?BookReadingStatus $readingStatus
    ) {}
}