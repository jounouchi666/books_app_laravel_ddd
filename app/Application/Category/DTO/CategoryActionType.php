<?php

namespace App\Application\Category\DTO;

enum CategoryActionType: string
{
    case Delete = 'delete';
    case Restore = 'restore';
    case None = 'none';
}