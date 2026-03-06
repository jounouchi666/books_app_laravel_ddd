<?php

namespace App\Application\Category\DTO;

/**
 * DTO
 * ByCategoryBooksDto
 */
final class ByCategoryBooksDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $title,
        public readonly int $count
    ) {}
    
    /**
     * labelを取得
     *
     * @return string
     */
    public function label(): string
    {
        return $this->title ?? '未分類';
    }
}