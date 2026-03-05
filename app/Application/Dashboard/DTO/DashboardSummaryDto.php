<?php

namespace App\Application\Dashboard\DTO;

use App\Application\Book\DTO\ReadingStatusCountsDto;

/**
 * DTO
 * DashboardSummaryDto
 */
final class DashboardSummaryDto
{
    public function __construct(
        public readonly ReadingStatusCountsDto $readingSummary,
        public readonly array $readingBooks,
        public readonly array $byCategoryBooks,
    ) {}
}