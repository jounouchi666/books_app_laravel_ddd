<?php

namespace App\Application\UI\Query;

/**
 * Interface
 * ユーザーフィルター
 */
interface HasUserFilter
{
    public function userId(): ?int;
    public function allUsers(): bool;
}