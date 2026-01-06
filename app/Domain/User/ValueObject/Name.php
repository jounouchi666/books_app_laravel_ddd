<?php

namespace App\Domain\User\ValueObject;

use InvalidArgumentException;

/**
 * 値オブジェクト
 * Name
 */
final class Name
{
    private const MIN_LENGTH = 1;
    private const MAX_LENGTH = 255;

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
     * @param Name $other
     * @return bool
     */
    public function equals(Name $other): bool
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
        if (empty($value)) throw new InvalidArgumentException('UserName must not be blank.');
        if (
            (mb_strlen($value) < self::MIN_LENGTH || mb_strlen($value) > self::MAX_LENGTH)
        ) throw new InvalidArgumentException('UserName must be between 2 and 100 characters.');
        return $value;
    }
}