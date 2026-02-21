<?php

namespace App\Application\Book\DTO;

/**
 * Book操作UseCaseのレスポンス用
*/
final class ActionBookResponse
{
    public function __construct(
        public readonly BookUIQuery $bookUIQuery,
        public readonly string $message,
    ) {}
}