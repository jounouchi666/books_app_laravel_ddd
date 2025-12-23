<?php

namespace App\Domain\Book\Repository;

use App\Domain\Book\Entity\Book;
use App\Domain\Book\ValueObject\BookId;

/**
 * インターフェース
 * Book
 */
interface BookRepositoryInterface
{
    /**
     * 全件取得
     *
     * @return Book[]
     */
    public function findAll(): array;
        
    /**
     * ID指定での取得
     *
     * @param  BookId $id
     * @return ?Book
     */
    public function findById(BookId $id): ?Book;

    /**
     * 新規保存/更新
     *
     * @param  Book $book
     * @return Book ID確定後のBook
     */
    public function save(Book $book): Book;
    
    /**
     * 削除
     *
     * @param  BookId $id
     * @return void
     */
    public function delete(BookId $id): void;
}