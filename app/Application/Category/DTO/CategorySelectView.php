<?php

namespace App\Application\Category\DTO;

/**
 * DTO
 * CategorySelectView
 * 
 * 原則Assemblerから作成する
 */
final class CategorySelectView
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
    ) {}
}