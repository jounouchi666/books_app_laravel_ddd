<?php

namespace App\Domain\Book\ValueObject;

use InvalidArgumentException;

/**
 * 値オブジェクト
 * BookTitle
 */
final class BookTitle
{
    private const MIN_LENGTH = 2;
    private const MAX_LENGTH = 100;

    private string $value;

    public function __construct(string $value)
    {
        $this->value = $this->validate($value);
    }
    
    /**
     * 値を取得
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

        
    /**
     * 同一性判断
     *
     * @param BookTitle $other
     * @return bool
     */
    public function equals(BookTitle $other): bool
    {
        return $this->value === $other->value();
    }
    
    /**
     * 文字数判断
     *
     * @param  string $value
     * @return string
     */
    private function validate(string $value): string
    {
        $value = trim($value);
        if (empty($value)) throw new InvalidArgumentException('BookTitle must not be blank.');
        if (
            (mb_strlen($value) < self::MIN_LENGTH || mb_strlen($value) > self::MAX_LENGTH)
        ) throw new InvalidArgumentException('Book title must be between 2 and 100 characters.');
        return $value;
    }
}