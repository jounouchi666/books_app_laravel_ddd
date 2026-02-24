<?php

namespace App\Domain\Book\Entity;

use App\Domain\Auth\AuthorizableResource;
use App\Domain\Book\ValueObject\BookId;
use App\Domain\Book\ValueObject\BookReadingStatus;
use App\Domain\Book\ValueObject\BookTitle;
use App\Domain\Shared\ValueObject\UserId;
use App\Domain\Shared\ValueObject\CategoryId;

/**
 * エンティティ
 * Book
 */
final class Book implements AuthorizableResource
{
    private function __construct(
        private readonly ?BookId $id,
        private BookTitle $title,
        private UserId $userId,
        private ?CategoryId $categoryId,
        private BookReadingStatus $readingStatus,
    ) {}

    /**
     * 認可対象キー
     * Modelを取得するために使用
     *
     * @return int|string
     */
    public function authorizationKey(): int|string
    {
        return $this->id()->value();
    }

    /**
     * 認可対象タイプ
     * Model判別に使用
     *
     * @return string
     */
    public function authorizationType(): string
    {
        return 'book';
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
        ?CategoryId $categoryId,
        BookReadingStatus $readingStatus,
    ): self {
        return new self(null, $title, $userId, $categoryId, $readingStatus);
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
        ?CategoryId $categoryId,
        BookReadingStatus $readingStatus,
    ): self {
        return new self($id, $title, $userId, $categoryId, $readingStatus);
    }
    
    /**
     * タイトル変更
     *
     * @param  BookTitle $title
     * @return void
     */
    public function changeTitle(BookTitle $title): void
    {
        if ($this->title->equals($title)) return;

        $this->title = $title;
    }

    /**
     * ユーザーID変更
     *
     * @param  UserId $userId
     * @return void
     */
    public function changeUser(UserId $userId): void
    {
        if ($this->userId->equals($userId)) return;

        $this->userId = $userId;
    }

    /**
     * カテゴリー変更
     *
     * @param  CategoryId $categoryId
     * @return void
     */
    public function changeCategory(?CategoryId $categoryId): void
    {
        if (is_null($this->categoryId) && is_null($categoryId)) return;
        if (
            !is_null($this->categoryId) &&
            !is_null($categoryId) &&
            $this->categoryId->equals($categoryId)
        ) return;
        
        $this->categoryId = $categoryId;
    }

    /**
     * 未読に変更
     *
     * @return void
     */
    public function markAsUnread(): void
    {
        $this->readingStatus = BookReadingStatus::Unread;
    }

    /**
     * 読書中に変更
     *
     * @return void
     */
    public function markAsReading(): void
    {
        $this->readingStatus = BookReadingStatus::Reading;
    }
        
    /**
     * 読了に変更
     *
     * @return void
     */
    public function markAsCompleted(): void
    {
        $this->readingStatus = BookReadingStatus::Completed;
    }
    
    /** Getter */
    public function id(): ?BookId {return $this->id;}
    public function title(): BookTitle {return $this->title;}
    public function userId(): UserId {return $this->userId;}
    public function categoryId(): ?CategoryId {return $this->categoryId;}
    public function isUnread(): bool {return $this->readingStatus->isUnread();}
    public function isReading(): bool {return $this->readingStatus->isReading();}
    public function isCompleted(): bool {return $this->readingStatus->isCompleted();}
}