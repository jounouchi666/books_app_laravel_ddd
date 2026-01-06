<?php

namespace App\Domain\User\Exception;

use App\Domain\Shared\ValueObject\UserId;
use RuntimeException;

final class UserNotFoundException extends RuntimeException
{
    public function __construct(UserId $id)
    {
        parent::__construct(
            'User not Found. ID='. $id->value()
        );
    }
}