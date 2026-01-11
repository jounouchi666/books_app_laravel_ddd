<?php

namespace App\Application\Auth\Permission;

/**
 * 抽象クラス
 * Permission
 * 
 * - ability: 操作内容（create / update / delete など）
 * - subject: 対象（クラス or エンティティ）
 */
abstract class Permission
{
    public function __construct(
        public readonly string $ability,
        public readonly string|object $subject
    ) {}
}