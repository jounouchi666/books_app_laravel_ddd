<?php

namespace App\Application\User\Repository;

use App\Infrastructure\Persistence\Eloquent\DTO\UserRecord;

/**
 * インターフェース
 * User
 */
interface UserRepositoryInterface
{  
    /**
     * 全件取得
     *
     * @return UserRecord[]
     */
    public function getList(): array;
}