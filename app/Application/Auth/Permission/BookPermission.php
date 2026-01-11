<?php

namespace App\Application\Auth\Permission;

use App\Domain\Book\Entity\Book;

/**
 * Book用Permission定義
 * 
 * Laravel Policy に渡す ability / subject を
 * 明示的なファクトリメソッドとして提供する
 */
final class BookPermission extends Permission
{
    private function __construct(
        string $ability,
        string|Book $subject
    ) {
        parent::__construct($ability, $subject);
    }
    
    /**
     * 更新権限
     *
     * @param  Book $book
     * @return self
     */
    public static function update(Book $book): self
    {
        return new self('update', $book);
    }
    
    /**
     * 削除
     *
     * @param  Book $book
     * @return self
     */
    public static function delete(Book $book): self
    {
        return new self('delete', $book);
    }
}