<?php

declare(strict_types=1);

namespace App\Exceptions;

class ViewException extends \Exception
{
    protected $message = 'Something went wrong with a view';

    
}