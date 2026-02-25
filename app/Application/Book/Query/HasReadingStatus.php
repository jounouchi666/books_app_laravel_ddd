<?php

namespace App\Application\Book\Query;

use App\Domain\Book\ValueObject\BookReadingStatus;

/**
 * Interface
 * 読書状況
 */
interface HasReadingStatus
{
    public function readingStatus(): ?BookReadingStatus;
}