<?php

namespace App\Application\Book\DTO;

use App\Domain\Book\ValueObject\BookReadingStatus;

/**
 * DTO
 * 保存フォーム用
 */
class SaveBookReadingStatusDto
{
    public function __construct(
        public readonly BookReadingStatus $readingStatus
    ) {}
}