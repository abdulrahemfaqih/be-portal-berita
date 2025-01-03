<?php

use App\Http\Middleware\CheckCommentOwnership;
use App\Http\Middleware\CheckPostOwnership;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "check.post.ownership" => CheckPostOwnership::class,
            "check.comment.ownership" => CheckCommentOwnership::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
