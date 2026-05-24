<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Tambahkan blok render ini untuk menangani JSON response di API
        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                // Mengecek apakah error memiliki status code, jika tidak default ke 500
                $statusCode = $e instanceof HttpException ? $e->getStatusCode() : 500;
                
                return response()->json([
                    'status' => 'error',
                    'data' => null,
                    'message' => $e->getMessage(),
                ], $statusCode);
            }
        });
    })->create();