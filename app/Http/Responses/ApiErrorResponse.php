<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class ApiErrorResponse extends JsonResponse
{
    public function __construct(
        mixed $message,
        int $statusCode = Response::HTTP_BAD_REQUEST,
        array $headers = [],
        int $options = 0
    ) {

        $name = $this->getStatusCodeName($statusCode);
        $error = [
            'error'=>[
                'code'=>$statusCode,
                'name'=>$name,
                'message'=>$message
            ]
        ];
        parent::__construct(
            $error,
            $statusCode,
            $headers,
            $options
        );
    }

    public function getStatusCodeName(int $statusCode): string
    {
        $statusCodes = [
            Response::HTTP_BAD_REQUEST => 'Bad Request',
            Response::HTTP_UNAUTHORIZED => 'Unauthorized',
            Response::HTTP_FORBIDDEN => 'Forbidden',
            Response::HTTP_NOT_FOUND => 'Not Found',
            Response::HTTP_INTERNAL_SERVER_ERROR => 'Internal Server Error',
            Response::HTTP_NOT_ACCEPTABLE => 'Not Acceptable',
        ];

        return $statusCodes[$statusCode] ?? 'Unknown'; 
    }
}  
