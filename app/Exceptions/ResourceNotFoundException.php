<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ResourceNotFoundException extends HttpException
{
    public function __construct(int $statusCode = 404, string $message = 'Resource Not Found')
    {
        parent::__construct($statusCode, $message);
    }
}
