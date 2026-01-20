<?php

namespace App\Application\Category\Query;

/**
 * クエリオブジェクト
 * Category検索用
 */
class ListCategoryQuery
{
    private const ALLOWED_SORTS = [
        'title',
        'created_at'
    ];

    private const ALLOWED_DIRECTIONS = [
        'desc',
        'asc'
    ];

    private const ALLOWED_TRASH_TYPES = [
        'active',
        'with_trashed',
        'only_trashed'
    ];

    private const SORT_DEFAULT = 'created_at';
    private const DIRECTION_DEFAULT = 'desc';
    private const TRASH_TYPE_DEFAULT = 'active';

    public readonly string $sort;
    public readonly string $direction;
    public readonly string $trashType;
    public readonly int $page;
    public readonly int $perPage;

    public function __construct(
        ?string $sort = null,
        ?string $direction = null,
        ?string $trashType = null,
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
     * @param  ?string $direction
     * @return string 不正なら強制的にデフォルト値を返す
     */
    private function filterDirection(?string $direction): string
    {
        if (is_null($direction)) return self::DIRECTION_DEFAULT;
        
        return in_array($direction, self::ALLOWED_DIRECTIONS, true)
            ? $direction
            : self::DIRECTION_DEFAULT;
    }

    /**
     * TrashType用フィルター
     *
     * @param  ?string $trashType
     * @return string 不正なら強制的にデフォルト値を返す
     */
    private function filterTrashType(?string $trashType): string
    {
        if (is_null($trashType)) return self::TRASH_TYPE_DEFAULT;
        
        return in_array($trashType, self::ALLOWED_TRASH_TYPES, true)
            ? $trashType
            : self::TRASH_TYPE_DEFAULT;
    }
}