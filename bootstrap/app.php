<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Responses\ApiErrorResponse;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        health: '/up',
        apiPrefix: '/',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e) {
            return new ApiErrorResponse('The requested endpoint does not exist.',Response::HTTP_NOT_FOUND);
        });
    })->create();
