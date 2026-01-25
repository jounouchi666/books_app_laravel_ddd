<?php

namespace App\Application\Category\DTO;

/**
 * DTO
 * CategoryUIQuery
 * 
 * クエリパラメータ用
 */
final class CategoryUIQuery
{
    public function __construct(
        public readonly ?string $sort,
        public readonly ?string $direction,
        public readonly ?string $trashType
    ) {}

    public function toQueryArray(): array
    {
        return array_filter([
            'sort' => $this->sort,
            'direction' => $this->direction,
            'trash_type' => $this->trashType,
        ]);
    }
}