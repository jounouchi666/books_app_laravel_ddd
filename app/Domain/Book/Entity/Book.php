<?php

namespace App\Domain\Book\Entity;

use App\Domain\Book\ValueObject\BookId;
use App\Domain\Book\ValueObject\BookTitle;
use App\Domain\Shared\ValueObject\UserId;
use App\Domain\Shared\ValueObject\CategoryId;

/**
 * エンティティ
 * Book
 */
final class Book
{
    private readonly ?BookId $id;
    private readonly BookTitle $title;
    private readonly UserId $userId;
    private readonly CategoryId $categoryId;

    private function __construct(
        ?BookId $bookId,
        BookTitle $title,
        UserId $userId,
        CategoryId $categoryId
    ) {
        $this->id = $bookId;
        $this->title = $title;
        $this->userId = $userId;
        $this->categoryId = $categoryId;
    }
    
    /**
     * 新規作成
     * IDを持たない状態
     *
     * @return self
     */
    public static function create(
        BookTitle $title,
        UserId $userId,
        CategoryId $categoryId
    ): self {
        return new self(null, $title, $userId, $categoryId);
    }
    
    /**
     * 再構築
     * IDを持っている状態
     *
     * @return self
     */
    public static function reconstruct(
        BookId $id,
        BookTitle $title,
        UserId $userId,
        CategoryId $categoryId
    ): self {
        return new self($id, $title, $userId, $categoryId);
    }
        
    /** Getter */
    public function id(): ?BookId {return $this->id;}
    public function title(): BookTitle {return $this->title;}
    public function userId(): UserId {return $this->userId;}
    public function categoryId(): CategoryId {return $this->categoryId;}
}