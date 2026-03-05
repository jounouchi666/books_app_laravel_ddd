<?php

namespace App\Application\Book\DTO;

/**
 * DTO
 * ReadingBookDto
 */
final class ReadingBookDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $title
    ) {}
}