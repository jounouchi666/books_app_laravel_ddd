<?php

namespace App\Application\Auth;

use App\Application\Auth\Permission\Permission;

/**
 * アプリケーションサービス
 * AuthorizationService
 * 
 * UseCaseから直接LaravelGateを呼ばせないための中継層
 */
class AuthorizationService
{
    public function __construct(
        private AuthorizationPort $AuthorizationPort
    ) {}

        
    /**
     * 認可実行
     *
     * @param  Permission $permission
     * @return void
     */
    public function authorize(Permission $permission): void
    {
        $this->AuthorizationPort->authorize($permission);
    }
}