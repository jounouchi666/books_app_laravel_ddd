<?php

namespace App\Domain\Book\ValueObject;

use InvalidArgumentException;

/**
 * 値オブジェクト
 * BookReadingStatus
 */
enum BookReadingStatus: string
{
    case Unread = 'unread';
    case Reading = 'reading';
    case Completed = 'completed';

    /**
     * ラベルを取得
     *
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            self::Unread => '未読',
            self::Reading => '読書中',
            self::Completed => '読了'
        };
    }
 
    /**
     * 読書状況が未読であるか
     *
     * @return bool
     */
    public function isUnread(): bool
    {
        return $this === self::Unread;
    }
    
    /**
     * 読書状況が読書中であるか
     *
     * @return bool
     */
    public function isReading(): bool
    {
        return $this === self::Reading;
    }

    /**
     * 読書状況が読了であるか
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this === self::Completed;
    }
}