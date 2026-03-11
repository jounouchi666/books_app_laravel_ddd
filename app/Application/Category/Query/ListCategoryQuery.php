<?php

namespace App\Application\Category\Query;

use App\Application\Shared\Enum\SortDirection;
use App\Application\Shared\Enum\TrashType;

/**
 * クエリオブジェクト
 * Category検索用
 */
class ListCategoryQuery
{
    private const ALLOWED_SORTS = [
        'id',
        'title',
        'created_at'
    ];

    private const SORT_DEFAULT = 'id';
    private const DIRECTION_DEFAULT = SortDirection::Asc;
    private const TRASH_TYPE_DEFAULT = TrashType::Without;

    public readonly string $sort;
    public readonly SortDirection $direction;
    public readonly TrashType $trashType;
    public readonly int $page;
    public readonly int $perPage;

    public function __construct(
        ?string $sort = null,
        ?SortDirection $direction = null,
        ?TrashType $trashType = null,
        int $page = 1,
        int $perPage = 50
    ) {
        $this->sort = $this->filterSort($sort);
        $this->direction = $this->filterDirection($direction);
        $this->trashType = $this->filterTrashType($trashType);
        $this->page = max(1, $page);
        $this->perPage = min(max(1, $perPage), 100);
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