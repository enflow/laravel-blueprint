<?php

namespace App\Exceptions;

use Enflow\Component\Laravel\AbstractExceptionHandler;

class Handler extends AbstractExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
