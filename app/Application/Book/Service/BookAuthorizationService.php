<?php

namespace App\Application\Book\Service;

use App\Domain\Shared\ValueObject\UserId;
use App\Domain\User\Entity\User;

/**
 * 
 * BookAuthorizationService
 */
class BookAuthorizationService
{
    /**
     * 新規作成権限
     *
     * @param  User $user
     * @return bool
     */
    public function canCreate(User $user) : bool
    {
        return $user->hasId();
    }

    /**
     * 編集権限
     *
     * @param  UserId $ownerId
     * @param  User $user
     * @return bool
     */
    public function canUpdate(UserId $ownerId, User $user): bool
    {
        if (!$user->hasId()) return false;
        
        return $user->id()->equals($ownerId)
            || $user->isAdmin();
    }

    /**
     * 削除権限
     *
     * @param  UserId $ownerId
     * @param  User $user
     * @return bool
     */
    public function canDelete(UserId $ownerId, User $user): bool
    {
        if (!$user->hasId()) return false;
        
        return $user->id()->equals($ownerId)
            || $user->isAdmin();
    }

    /**
     * 復元権限
     *
     * @param  UserId $ownerId
     * @param  User $user
     * @return bool
     */
    public function canRestore(UserId $ownerId, User $user): bool
    {
        return $user->hasId() && $user->isAdmin();
    }

    /**
     * 物理削除権限
     *
     * @param  UserId $ownerId
     * @param  User $user
     * @return bool
     */
    public function canForceDelete(UserId $ownerId, User $user): bool
    {
        return $user->hasId() && $user->isAdmin();
    }
}