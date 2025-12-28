<?php

namespace App\Domain\Category\Exception;

use App\Domain\Shared\ValueObject\CategoryId;
use RuntimeException;

final class CategoryNotFoundException extends RuntimeException
{
    public function __construct(CategoryId $id)
    {
        parent::__construct(
            'Category not Found. ID='. $id->value()
        );
    }
}