<?php

namespace app\Application\UI\Query;

/**
 * DTO
 * UIQuery
 * 
 * クエリパラメータ用
 * 
 * null = 管理者でないため非表示
 */
abstract class UIQuery
{
    public function __construct(
        public readonly ?string $sort,
        public readonly ?string $direction,
        public readonly ?string $trashType
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