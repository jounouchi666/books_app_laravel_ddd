<?php

namespace App\Application\UI\Query;

/**
 * Interface
 * 読書状況
 */
interface HasReadingStatus
{
    public function readingStatus(): string;
}