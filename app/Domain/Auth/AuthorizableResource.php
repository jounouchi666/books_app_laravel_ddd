<?php

namespace App\Domain\Auth;

/** 
 * 認可対象インターフェース
 */
interface AuthorizableResource
{
        
    /**
     * キー
     * Modelを取得するために使用
     *
     * @return int|string
     */
    public function authorizationKey(): int|string;
        
    /**
     * タイプ
     * Model判別に使用
     *
     * @return string
     */
    public function authorizationType(): string;
}