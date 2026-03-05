<?php

namespace App\Application\Category\DTO;

/**
 * DTO
 * ByCategoryBooksDto
 */
final class ByCategoryBooksDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $count
    ) {}
}