<?php

namespace App\Application\Book\DTO;

/**
 * DTO
 * BookUIQuery
 * 
 * クエリパラメータ用
 */
final class BookUIQuery
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