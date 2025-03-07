<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware = [
            // Middleware lainnya...
            'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'PDF' => Barryvdh\Snappy\Facades\SnappyPdf::class,
            'SnappyImage' => Barryvdh\Snappy\Facades\SnappyImage::class,
            'Image' => Intervention\Image\Facades\Image::class,
        
        ];
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
