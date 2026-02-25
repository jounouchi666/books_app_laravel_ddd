<?php

namespace App\Application\Shared\Enum;

enum TrashType: string
{
    case All = 'all';
    case Without = 'without';
    case Only = 'only';

    public function label(): string
    {
        return match($this) {
            self::All => '含む',
            self::Without => '含まない',
            self::Only => '削除済みのみ'
        };
    }
        
    /**
     * 削除済みを含むか
     *
     * @return bool
     */
    public function includeTrashed(): bool
    {
        return $this === self::All || $this === self::Only;
    }

        
    /**
     * 削除済みのみか
     *
     * @return bool
     */
    public function onlyTrashed(): bool
    {
        return $this === self::Only;
    }
}