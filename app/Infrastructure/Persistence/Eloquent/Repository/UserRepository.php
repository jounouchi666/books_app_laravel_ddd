<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\DTO\UserRecord;
use App\Models\User;

/**
 * リポジトリー
 * User
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * 全件取得
     *
     * @return UserRecord[]
     */
    public function getList(): array
    {
        $q = User::query()->get(['id', 'name']);

        return UserRecord::fromModels($q->all());
    }
}