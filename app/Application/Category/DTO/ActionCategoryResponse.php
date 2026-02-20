<?php

namespace App\Application\Category\DTO;

/**
 * Category操作UseCaseのレスポンス用
*/
final class ActionCategoryResponse
{
    public function __construct(
        public readonly CategoryUIQuery $categoryUIQuery,
        public readonly string $message,
    ) {}
}