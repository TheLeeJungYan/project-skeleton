<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Responses\ApiErrorResponse;
class EnsureJsonRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->isJson()) {
            $message = 'The request must be in JSON format.';
            $code = Response::HTTP_UNSUPPORTED_MEDIA_TYPE;

            return new ApiErrorResponse($message,$code);
        }
        return $next($request);
    }
}
