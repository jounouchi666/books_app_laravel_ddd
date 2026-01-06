<?php

namespace App\Application\Auth;

use App\Domain\User\Entity\User;

interface CurrentUserProvider
{
    public function currentUser(): User;
}