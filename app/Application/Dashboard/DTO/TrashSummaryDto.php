<?php

namespace App\Application\Dashboard\DTO;

/**
 * DTO
 * TrashSummaryDto
 */
final class TrashSummaryDto
{
    public function __construct(
        public readonly int $booksCount,
        public readonly int $categoriesCount
    ) {}

    /**
     * 値が全て0のインスタンスを生成
     *
     * @return self
     */
    public static function blank(): self
    {
        return new self(0, 0);    
    }
}