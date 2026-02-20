<?php

namespace App\Application\Category\Service;

use App\Domain\User\Entity\User;

/**
 * 
 * CategoryAuthorizationService
 */
class CategoryAuthorizationService
{
    /**
     * 新規作成権限
     *
     * @param  User $user
     * @return bool
     */
    public function canCreate(User $user) : bool
    {
        return $user->hasId() && $user->isAdmin();
    }

    /**
     * 編集権限
     *
     * @param  User $user
     * @return bool
     */
    public function canUpdate(User $user): bool
    {
        return $user->hasId() && $user->isAdmin();
    }

    /**
     * 削除権限
     *
     * @param  User $user
     * @return bool
     */
    public function canDelete(User $user): bool
    {
        return $user->hasId() && $user->isAdmin();
    }

    /**
     * 復元権限
     *
     * @param  User $user
     * @return bool
     */
    public function canRestore(User $user): bool
    {
        return $user->hasId() && $user->isAdmin();
    }

    /**
     * 物理削除権限
     *
     * @param  User $user
     * @return bool
     */
    public function canForceDelete(User $user): bool
    {
        return $user->hasId() && $user->isAdmin();
    }
}