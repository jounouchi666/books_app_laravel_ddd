<?php

namespace App\Domain\Book\Exception;

use App\Domain\Book\ValueObject\BookId;
use RuntimeException;

final class BookNotFoundException extends RuntimeException
{
    public function __construct(BookId $id)
    {
        parent::__construct(
            'Book not Found. ID='. $id->value()
        );
    }
}