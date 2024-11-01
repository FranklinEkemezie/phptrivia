<?php

declare(strict_types=1);

namespace App\Exceptions;

class ControllerException extends \Exception
{
    protected $message = 'A controller error occurred';
}