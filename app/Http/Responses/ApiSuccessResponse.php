<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
class ApiSuccessResponse extends JsonResponse
{
    public function __construct(
        mixed $value,
        int $statusCode = Response::HTTP_OK,
        array $headers = [],
        int $options = 0
    ) {
        parent::__construct(
            ['data' => $value],
            $statusCode,
            $headers,
            $options
        );
    }
}  
