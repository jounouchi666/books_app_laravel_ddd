<?php

namespace App\Application\Book\DTO;

use App\Application\UI\DTO\TrashActionType;

/**
 * DTO
 * BookView
 * 
 * 原則Assemblerから作成する
 */
final class BookView
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $userId,
        public readonly string $userName,
        public readonly ?int $categoryId,
        public readonly string $categoryTitle,
        public readonly bool $canUpdate,
        public readonly bool $canDelete,
        public readonly bool $canRestore,
        public readonly bool $canForceDelete,
        public readonly bool $trashed,
        public readonly TrashActionType $actionType
    ) {}
}