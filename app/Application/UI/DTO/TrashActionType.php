<?php

namespace App\Application\UI\DTO;

enum TrashActionType: string
{
    case Delete = 'delete';
    case Restore = 'restore';
    case None = 'none';
}