<?php

namespace App\Application\Auth;

use App\Application\Auth\Permission\Permission;

/**
 * インターフェース
 * AuthorizationPort
 * 
 * 認可処理のポート
 */
interface AuthorizationPort
{
    public function authorize(Permission $permission): void;
}