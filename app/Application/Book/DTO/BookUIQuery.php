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
        public readonly ?int $userId,
        public readonly ?bool $allUser,
        public readonly ?string $sort,
        public readonly ?string $direction,
        public readonly ?string $trashType
    ) {}

    public function toQueryArray(): array
    {
        $queryArray = [
            'sort' => $this->sort,
            'direction' => $this->direction,
        ];

        // 管理者用
        if (!is_null($this->userId)) {
            $queryArray = [
                'user_id' => $this->userId,
                ...$queryArray
            ];
        }

        if (!is_null($this->allUser)) {
            $queryArray = [
                'all_user' => $this->allUser,
                ...$queryArray
            ];
        }

        if (!is_null($this->trashType)) {
            $queryArray = [
                'trash_type' => $this->trashType,
                ...$queryArray
            ];
        }

        return $queryArray;
    }
}