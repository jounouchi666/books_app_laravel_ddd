<?php

namespace App\Application\Category\DTO;

/**
 * DTO
 * 保存フォーム用
 */
class SaveCategoryDto
{
    public function __construct(
        public readonly string $title
    ) {}
}