<?php

namespace App\Infrastructure\Auth;

use App\Application\Auth\AuthorizationPort;
use App\Application\Auth\Permission\Permission;
use App\Domain\Auth\AuthorizableResource;
use App\Domain\Book\Entity\Book;
use Illuminate\Support\Facades\Gate;
use LogicException;

/**
 * LaravelAuthorizationAdapter
 * 
 * LaravelGateを用いた認可アダプタ
 * ※複数レコードで使用しない（DBアクセスが増えるため）
 */
class LaravelAuthorizationAdapter implements AuthorizationPort
{
    private CONST MODEL_MAP = [
        'user' => \App\Models\User::class,
        'book' => \App\Models\Book::class,
        'category' => \App\Models\Category::class,
    ];

    public function authorize(Permission $permission): void
    {
        $subject = $permission->subject;

        // Entityの場合はModelを取得
        if ($subject instanceof AuthorizableResource) {
            $modelClass = self::MODEL_MAP[$subject->authorizationType()]
                ?? throw new LogicException('Unsupported authorization resource');
            $subject = $modelClass::withTrashed()->findOrFail($subject->authorizationKey());
        }

        Gate::authorize(
            $permission->ability,
            $subject
        );
    }
}