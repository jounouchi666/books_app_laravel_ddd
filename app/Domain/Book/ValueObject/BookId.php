<?php

namespace App\Domain\Book\ValueObject;

use InvalidArgumentException;

/**
 * 値オブジェクト
 * BookId
 */
final class BookId
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $this->validate($value);
    }
    
    /**
     * 値を取得
     *
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

        
    /**
     * 同一性判断
     *
     * @param BookId $other
     * @return bool
     */
    public function equals(BookId $other): bool
    {
        return $this->value === $other->value();
    }
    
    /**
     * 整数判断
     *
     * @param  int $value
     * @return int
     */
    private function validate(int $value): int
    {
        if ($value < 1) throw new InvalidArgumentException(
            'BookId must be a positive integer.'
        );
        return $value;
    }
}