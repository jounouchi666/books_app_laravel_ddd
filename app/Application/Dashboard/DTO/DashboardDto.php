<?php

namespace App\Application\Dashboard\DTO;

use App\Application\Book\DTO\ReadingStatusCountsDto;

/**
 * DTO
 * DashboardDto
 */
final class DashboardDto
{
    public function __construct(
        public readonly ReadingStatusCountsDto $readingSummary,
        public readonly array $readingBooks,
        public readonly array $byCategoryBooks,
        public readonly TrashSummaryDto $trashSummary
    ) {}
}