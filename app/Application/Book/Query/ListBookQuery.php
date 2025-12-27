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

    public readonly ?int $userId;
    public readonly ?int $categoryId;
    public readonly string $sort;
    public readonly string $direction;

    public function __construct(
        ?int $userId = null,
        ?int $categoryId = null,
        string $sort = 'created_at',
        string $direction = 'desc'
    ) {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
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