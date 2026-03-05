<?php

namespace App\Application\Book\DTO;

/**
 * DTO
 * ReadingStatusCountsDto
 */
final class ReadingStatusCountsDto
{
    public function __construct(
        public readonly int $unreadCount,
        public readonly int $readingCount,
        public readonly int $completedCount
    ) {}
}