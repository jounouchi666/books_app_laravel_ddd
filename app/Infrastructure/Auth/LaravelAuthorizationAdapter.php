<?php

namespace App\Infrastructure\Auth;

use App\Application\Auth\AuthorizationPort;
use App\Application\Auth\Permission\Permission;
use Illuminate\Support\Facades\Gate;

/**
 * LaravelAuthorizationAdapter
 * 
 * LaravelGateを用いた認可アダプタ
 */
class LaravelAuthorizationAdapter implements AuthorizationPort
{
    public function authorize(Permission $permission): void
    {
        Gate::authorize(
            $permission->ability,
            $permission->subject
        );
    }
}