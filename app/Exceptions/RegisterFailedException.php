<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class RegisterFailedException extends HttpException
{
    public function __construct()
    {
        parent::__construct(409, 'User already exists');
    }
}
