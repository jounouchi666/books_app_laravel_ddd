<?php

namespace App\Application\Book\DTO;

use App\Application\Book\Query\ListBookQuery;

/**
 * DTO
 * BookUIQuery
 * 
 * クエリパラメータ用
 * 
 * null = 管理者でないため非表示
 */
final class BookUIQuery
{
    public function __construct(
        public readonly bool $isAdmin,
        public readonly ?int $userId,
        public readonly bool $allUsers,
        public readonly ?string $sort,
        public readonly ?string $direction,
        public readonly ?string $trashType
    ) {}
    
    /**
     * ListBookQueryから生成
     *
     * @param  ListBookQuery $query
     * @param  bool $isAdmin
     * @return self
     */
    public static function fromQuery(ListBookQuery $query, bool $isAdmin): self
    {
        return new self(
            $isAdmin,
            $isAdmin ? $query->userId : null,
            $query->allUsers,
            $query->sort,
            $query->direction,
            $isAdmin ? $query->trashType : null
        );
    }
    
    /**
     * クエリを配列化
     *
     * @return array
     */
    public function toQueryArray(): array
    {
        $queryArray = [
            'sort' => $this->sort,
            'direction' => $this->direction,
        ];

        if(!$this->isAdmin) return $queryArray;

        // 管理者用
        if($this->allUsers) {
            $queryArray = [
                'all_users' => 1,
                ...$queryArray
            ];
        }

        if ($this->isAdmin && !is_null($this->userId)) {
            $queryArray = [
                'user_id' => $this->userId,
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