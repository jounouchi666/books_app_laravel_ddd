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

    private const SORT_COLUMNS = [
        'title' => 'categories.title',
        'created_at' => 'categories.created_at'
    ];

    public readonly string $sort;
    public readonly string $direction;

    public function __construct(
        string $sort = 'created_at',
        string $direction = 'desc'
    ) {
        $this->sort = $this->filterSort($sort);
        $this->direction = $this->filterDirection($direction);
    }
    
    /**
     * Sort用フィルター
     *
     * @param  string $sort
     * @return string 不正なら強制的に'created_at'を返す
     */
    private function filterSort(string $sort): string
    {
        return in_array($sort, self::ALLOWED_SORTS, true)
            ? $sort
            : 'created_at';
    }
    
    /**
     * Direction用フィルター
     *
     * @param  string $direction
     * @return string 不正なら強制的に'desc'を返す
     */
    private function filterDirection(string $direction): string
    {
        return in_array($direction, self::ALLOWED_DIRECTIONS, true)
            ? $direction
            : 'desc';
    }
    
    /**
     * sort対象のカラム名を取得
     *
     * @return string
     */
    public function sortColumn(): string
    {
        return self::SORT_COLUMNS[$this->sort];
    }
}