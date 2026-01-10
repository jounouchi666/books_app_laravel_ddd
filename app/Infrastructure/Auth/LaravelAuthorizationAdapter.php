<?php

namespace App\Infrastructure\Auth;

use App\Application\Auth\AuthorizationPort;
use App\Application\Auth\Permission\Permission;
use App\Domain\Book\Entity\Book;
use App\Models\Book as ModelsBook;
use Illuminate\Support\Facades\Gate;

/**
 * LaravelAuthorizationAdapter
 * 
 * LaravelGateを用いた認可アダプタ
 * ※複数レコードで使用しない（DBアクセスが増えるため）
 */
class LaravelAuthorizationAdapter implements AuthorizationPort
{
    public function authorize(Permission $permission): void
    {
        $subject = $permission->subject;

        // Entityの場合はModelを取得
        if ($subject instanceof Book) {
            $subject = ModelsBook::findOrFail($subject->id()->value());
        }

        Gate::authorize(
            $permission->ability,
            $subject
        );
    }
}