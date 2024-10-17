<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Response;

class AuthController extends BaseController
{

    public function displayLogin(): Response
    {
        echo 'Display login form';
        return new Response;
    }

    public function login(): Response
    {
        echo 'Logging in...';
        return new Response;
    }

    public function displaySignup(): Response
    {
        echo 'Display sign up form';
        return new Response;
    }

    public function signup(): Response
    {
        echo 'Signing up...';
        return new Response;
    }


}