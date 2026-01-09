<?php

namespace App\Application\UI\Service;

use App\Domain\User\Entity\User;

/**
 * 
 * NavigationAuthorizationService
 */
class NavigationAuthorizationService
{
    /**
     * 管理者権限
     *
     * @param  User $user
     * @return bool
     */
    public function canManage(User $user) : bool
    {
        return $user->hasId() && $user->isAdmin();
    }
}