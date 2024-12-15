<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
class ActiveEmploymentException extends Exception
{
    protected $message = 'Cannot assign a new employment history while the worker is still actively employed.';
    protected $code = Response::HTTP_BAD_REQUEST;

    public function getStatusCode()
    {
        return $this->code;
    }
}
