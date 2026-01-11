<?php

namespace App\Infrastructure\Auth;

use App\Application\Auth\CurrentUserProvider;
use App\Domain\Shared\ValueObject\UserId;
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Name;
use Illuminate\Support\Facades\Auth;

class LaravelCurrentUserProvider implements CurrentUserProvider
{
    public function currentUser(): User
    {
        $user = Auth::user();

        return is_null($user)
            ? User::guest()
            : User::reconstruct(
                new UserId($user->id),
                new Name($user->name),
                $user->is_admin
            );
    }
}