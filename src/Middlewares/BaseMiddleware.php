<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Utils\Request;

abstract class BaseMiddleware
{

    abstract public function handle(
        Request $request
    );
}



