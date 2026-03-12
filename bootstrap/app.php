<?php

use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Category\Exception\CategoryNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (BookNotFoundException|CategoryNotFoundException $e) {
            return response()->view('errors.404', [], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function(TokenMismatchException $e) {
            return back()->with('error', 'セッションの期限が切れました。もう一度操作してください。');
        });
    })->create();
