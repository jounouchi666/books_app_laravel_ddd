<?php

namespace App\Application\Book\DTO;

use App\Application\UI\DTO\TrashActionType;
use App\Domain\Book\ValueObject\BookReadingStatus;
use DateTimeImmutable;

/**
 * DTO
 * BookView
 * 
 * 原則Assemblerから作成する
 */
final class BookView
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $userId,
        public readonly string $userName,
        public readonly ?int $categoryId,
        public readonly string $categoryTitle,
        public readonly BookReadingStatus $readingStatus,
        public readonly string $updated_at,
        public readonly string $created_at,
        public readonly bool $canUpdate,
        public readonly bool $canDelete,
        public readonly bool $canRestore,
        public readonly bool $canForceDelete,
        public readonly bool $trashed,
        public readonly bool $categoryTrashed,
        public readonly TrashActionType $actionType
    ) {}
    
    /**
     * 削除状態ラベル
     *
     * @return string
     */
    public function trashedLabel(): string
    {
        return $this->trashed ? '削除済み': '';
    }
    
    /**
     * カテゴリーラベル
     * 削除されていると削除済みの文字列を返す
     *
     * @return string
     */
    public function categoryLabel(): string
    {
        if ($this->categoryTrashed) {
            return '削除されたカテゴリー';
        }

        if (is_null($this->categoryId)) {
            return 'カテゴリーなし';
        }
        
        return $this->categoryTitle;
    }
 
    /**
     * 更新日時
     *
     * @return string
     */
    public function updated_at(): string
    {
        return $this->formatToSlash($this->updated_at);
    }

    /**
     * 登録日時
     *
     * @return string
     */
    public function created_at(): string
    {
        return $this->formatToSlash($this->created_at);
    }

    private function formatToSlash(string $dateTimeString): string
    {
        $date = new DateTimeImmutable($dateTimeString);
        return $date->format('Y/m/d H:i');
    }
}