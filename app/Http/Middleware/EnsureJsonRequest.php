<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\JsonResponse;
class EnsureJsonRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if (!$request->isJson()) {
            $message = 'The request must be in JSON format.';
            $statusCode = Response::HTTP_UNSUPPORTED_MEDIA_TYPE;
            return new ApiErrorResponse($message,$statusCode);
        }
        return $next($request);
    }
}
