<?php

namespace App\Application\Category\DTO;

/**
 * DTO
 * CategoryView
 * 
 * 原則Assemblerから作成する
 */
final class CategoryView
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly bool $canUpdate,
        public readonly bool $canDelete,
        public readonly bool $canRestore,
        public readonly bool $canForceDelete,
        public readonly bool $trashed,
        public readonly CategoryActionType $actionType
    ) {}
}