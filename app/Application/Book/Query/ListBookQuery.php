<?php

namespace App\Application\Book\Query;

use App\Application\Shared\Enum\SortDirection;
use App\Application\Shared\Enum\TrashType;
use App\Domain\Book\ValueObject\BookReadingStatus;

/**
 * クエリオブジェクト
 * Book検索用
 */
class ListBookQuery
{
    private const ALLOWED_SORTS = [
        'title',
        'user_id',
        'category_id',
        'created_at'
    ];

    private const READING_STATUS_DEFAULT = null;
    private const SORT_DEFAULT = 'created_at';
    private const DIRECTION_DEFAULT = SortDirection::Desc;
    private const TRASH_TYPE_DEFAULT = TrashType::Without;

    public readonly ?int $userId;
    public readonly bool $allUsers;
    public readonly ?int $categoryId;
    public readonly ?BookReadingStatus $readingStatus;
    public readonly string $sort;
    public readonly SortDirection $direction;
    public readonly TrashType $trashType;
    public readonly int $page;
    public readonly int $perPage;

    public function __construct(
        ?int $userId = null,
        bool $allUsers = false,
        ?int $categoryId = null,
        ?BookReadingStatus $readingStatus = null,
        ?string $sort = null,
        ?SortDirection $direction = null,
        ?TrashType $trashType = null,
        int $page = 1,
        int $perPage = 15
    ) {
        $this->userId = $userId;
        $this->allUsers = $allUsers;
        $this->categoryId = $categoryId;
        $this->readingStatus = $this->filterReadingStatus($readingStatus);
        $this->sort = $this->filterSort($sort);
        $this->direction = $this->filterDirection($direction);
        $this->trashType = $this->filterTrashType($trashType);
        $this->page = max(1, $page);
        $this->perPage = min(max(1, $perPage), 100);
    }

    /**
     * ReadingStatus用フィルター
     *
     * @param  ?BookReadingStatus $readingStatus
     * @return ?BookReadingStatus 不正なら強制的にデフォルト値を返す
     */
    private function filterReadingStatus(?BookReadingStatus $readingStatus): ?BookReadingStatus
    {
        return $readingStatus ?? self::READING_STATUS_DEFAULT;
    }
    
    /**
     * Sort用フィルター
     *
     * @param  ?string $sort
     * @return string 不正なら強制的にデフォルト値を返す
     */
    private function filterSort(?string $sort): string
    {
        if (is_null($sort)) return self::SORT_DEFAULT;

        return in_array($sort, self::ALLOWED_SORTS, true)
            ? $sort
            : self::SORT_DEFAULT;
    }
    
    /**
     * Direction用フィルター
     *
     * @param  ?SortDirection $direction
     * @return SortDirection 不正なら強制的にデフォルト値を返す
     */
    private function filterDirection(?SortDirection $direction): SortDirection
    {
        return $direction ?? self::DIRECTION_DEFAULT;
    }

    /**
     * TrashType用フィルター
     *
     * @param  ?TrashType $trashType
     * @return TrashType 不正なら強制的にデフォルト値を返す
     */
    private function filterTrashType(?TrashType $trashType): TrashType
    {
        return $trashType ?? self::TRASH_TYPE_DEFAULT;
    }
}