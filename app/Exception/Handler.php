<?php

namespace App\Exception;

use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Category\Exception\CategoryNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;

class Handler extends ExceptionsHandler
{
    public function register()
    {
        return $this->renderable(function (BookNotFoundException|CategoryNotFoundException $e) {
            return abort(404);
        });
    }
}