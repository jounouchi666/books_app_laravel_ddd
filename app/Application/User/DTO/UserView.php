<?php

namespace App\Application\User\DTO;

/**
 * DTO
 * UserView
 * 
 * ユーザー
 */
final class UserView
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    ) {}
}