<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Response;

class AuthController extends BaseController
{

    public function displayLogin(): Response
    {
        echo 'Display login form';

        prettyPrint($this->request->POST());

        return new Response(200, "");
    }

    public function login(): Response
    {
        echo 'Logging in...';
        return new Response(200, "");
    }

    public function displaySignup(): Response
    {
        echo 'Display sign up form';
        return new Response(200, "");
    }

    public function signup(): Response
    {
        echo 'Signing up...';
        return new Response(200, "");
    }


}