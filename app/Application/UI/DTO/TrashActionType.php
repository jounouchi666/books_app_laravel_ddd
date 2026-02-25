<?php

namespace App\Application\UI\DTO;

enum TrashActionType: string
{
    case Delete = 'delete';
    case Restore = 'restore';
    case None = 'none';

    public function isDelete(): bool
    {
        return $this === self::Delete;
    }

    public function isRestore(): bool
    {
        return $this === self::Restore;
    }
}