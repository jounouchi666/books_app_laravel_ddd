<?php

namespace App\Infrastructure\Persistence\Eloquent\DTO;

use App\Models\User;
use LogicException;

/**
 * DTO
 * UserRecord
 */
final class UserRecord
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}

    /**
     * モデルからインスタンスを作成
     *
     * @param  User $user
     * @return self
     */
    public static function fromModel(User $user): self
    {
        if (is_null($user->id)) throw new LogicException('User must have id');

        return new self(
            $user->id,
            $user->name,
        );
    }

    /**
     * モデルの配列からインスタンスを作成
     *
     * @param  User[] $users
     * @return self
     */
    public static function fromModels(array $users): array
    {
        return array_map(
            fn(User $user) => self::fromModel($user),  
            $users
        );
    }
}