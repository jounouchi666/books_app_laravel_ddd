<?php

namespace App\Domain\User\Entity;

use App\Domain\Shared\ValueObject\UserId;
use App\Domain\User\ValueObject\Name;

/**
 * エンティティ
 * User
 */
final class User
{
    private function __construct(
        private readonly ?UserId $id,
        private Name $name,
        private bool $isAdmin
    ) {}

    /**
     * 新規作成
     * IDを持たない状態
     *
     * @return self
     */
    public static function create(
        Name $name,
        bool $isAdmin
    ): self {
        return new self(null, $name, $isAdmin);
    }
    
    /**
     * 再構築
     * IDを持っている状態
     *
     * @return self
     */
    public static function reconstruct(
        UserId $id,
        Name $name,
        bool $isAdmin
    ): self {
        return new self($id, $name, $isAdmin);
    }
    
    /**
     * ゲストユーザーを作成
     *
     * @return self
     */
    public static function guest(): self
    {
        return new self(
            null,
            new Name('Guest'),
            false
        );
    }
    
    /**
     * ユーザー名変更
     *
     * @param  Name $name
     * @return void
     */
    public function changeUserName(Name $name): void
    {
        if ($this->name->equals($name)) return;

        $this->name = $name;
    }
    
    /**
     * ID存在チェック
     *
     * @return bool
     */
    public function hasId(): bool
    {
        return ! is_null($this->id);
    }

    /** Getter */
    public function id(): ?UserId {return $this->id;}
    public function name(): Name {return $this->name;}
    public function isAdmin(): bool {return $this->isAdmin;}
}