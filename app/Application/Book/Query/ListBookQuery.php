<?php

namespace App\Application\Book\Query;

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

    private const ALLOWED_DIRECTIONS = [
        'desc',
        'asc'
    ];

    private const SORT_COLUMNS = [
        'title' => 'books.title',
        'user_id' => 'books.user_id',
        'category_id' => 'books.category_id',
        'created_at' => 'books.created_at'
    ];

    private const SORT_DEFAULT = 'created_at';
    private const DIRECTION_DEFAULT = 'desc';

    public readonly ?int $userId;
    public readonly ?int $categoryId;
    public readonly string $sort;
    public readonly string $direction;
    public readonly int $page;
    public readonly int $perPage;

    public function __construct(
        ?int $userId = null,
        ?int $categoryId = null,
        ?string $sort = null,
        ?string $direction = null,
        int $page = 1,
        int $perPage = 15
    ) {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->sort = $this->filterSort($sort);
        $this->direction = $this->filterDirection($direction);
        $this->page = max(1, $page);
        $this->perPage = min(max(1, $perPage), 100);
    }
    
    /**
     * Sort用フィルター
     *
     * @param  ?string $sort
     * @return string 不正なら強制的に'created_at'を返す
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
     * @return string 不正なら強制的に'desc'を返す
     */
    private function filterDirection(?string $direction): string
    {
        if (is_null($direction)) return self::DIRECTION_DEFAULT;

        return in_array($direction, self::ALLOWED_DIRECTIONS, true)
            ? $direction
            : self::DIRECTION_DEFAULT;
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