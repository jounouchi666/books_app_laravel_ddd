<?php

namespace App\Application\UI\Query;

use App\Application\Shared\Enum\SortDirection;
use App\Application\Shared\Enum\TrashType;

/**
 * DTO
 * UIQuery
 * 
 * クエリパラメータ用
 */
abstract class UIQuery
{
    public function __construct(
        public readonly string $sort,
        public readonly SortDirection $direction,
        public readonly ?TrashType $trashType
    ) {}

    /**
     * クエリを配列化
     *
     * @return array
     */
    abstract public function toQueryArray(): array;
    
    /**
     * 指定したキーを除外した配列を取得
     *
     * @param  array $keys
     * @return array
     */
    public function except(array $keys): array
    {
        $array = $this->toQueryArray();

        foreach ($keys as $key) {
            unset($array[$key]);
        }
        return $array;
    }
}