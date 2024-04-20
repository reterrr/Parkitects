<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class SuperAdminDelete extends Exception
{
    public function __construct(string $message = "Not Allowed", int $code = 403, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
