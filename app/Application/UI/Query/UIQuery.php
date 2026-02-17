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
class UIQuery
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