<?php

namespace App\Application\Shared\Enum;

enum SortDirection: string
{
    case Asc = 'asc';
    case Desc = 'desc';

    /**
     * ラベルを取得
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::Asc => '昇順',
            self::Desc => '降順'
        };
    }
    
    /**
     * 昇順か
     *
     * @return bool
     */
    public function isAsc(): bool
    {
        return $this === self::Asc;    
    }
    
    /**
     * 降順か
     *
     * @return bool
     */
    public function isDesc(): bool
    {
        return $this === self::Desc;
    }
}