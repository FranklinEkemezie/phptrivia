<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Utils\Request;
use App\Utils\Response;

class AuthMiddleware extends BaseMiddleware
{

    public function __construct(private array $routes)
    {

    }


    public function handle(Request $request): true
    {
        // echo "Authenticating user... Please wait!";


        return true;
    }
}