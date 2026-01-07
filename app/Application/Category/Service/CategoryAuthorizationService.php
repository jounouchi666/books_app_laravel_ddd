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
     * 編集権限
     *
     * @param  User $user
     * @return bool
     */
    public function canUpdate(User $user): bool
    {
        if (!$user->hasId()) return false;
        
        return $user->isAdmin();
    }

    /**
     * 削除権限
     *
     * @param  User $user
     * @return bool
     */
    public function canDelete(User $user): bool
    {
        if (!$user->hasId()) return false;
        
        return $user->isAdmin();
    }
}