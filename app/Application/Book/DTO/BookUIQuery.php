<?php

namespace App\Application\Book\DTO;

use App\Application\Book\Query\ListBookQuery;
use App\Application\UI\Query\HasReadingStatus;
use App\Application\UI\Query\HasUserFilter;
use App\Application\UI\Query\UIQuery;

/**
 * DTO
 * BookUIQuery
 * 
 * クエリパラメータ用
 */
final class BookUIQuery extends UIQuery implements HasUserFilter, HasReadingStatus
{   
    public readonly bool $isAdmin;
    public readonly ?int $userId;
    public readonly bool $allUsers;
    public readonly string $readingStatus;

    public function __construct(
        bool $isAdmin,
        ?int $userId,
        bool $allUsers,
        string $readingStatus,
        ?string $sort,
        ?string $direction,
        ?string $trashType
    ) {
        parent::__construct($sort, $direction, $trashType);

        $this->isAdmin = $isAdmin;
        $this->userId = $userId;
        $this->allUsers = $allUsers;
        $this->readingStatus = $readingStatus;
    }

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
            $query->readingStatus,
            $query->sort,
            $query->direction,
            $isAdmin ? $query->trashType : null
        );
    }
    
    /**
     * Getter
     * userId
     *
     * @return int
     */
    public function userId(): ?int
    {
        return $this->userId;
    }
    
    /**
     * Getter
     * allUsers
     *
     * @return bool
     */
    public function allUsers(): bool
    {
        return $this->allUsers;
    }

    /**
     * Getter
     * readingStatus
     *
     * @return bool
     */
    public function readingStatus(): string
    {
        return $this->readingStatus;
    }

    /**
     * クエリを配列化
     *
     * @return array
     */
    public function toQueryArray(): array
    {
        $queryArray = [
            'reading_status' => $this->readingStatus,
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