<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Response;

class AuthController extends BaseController
{

    public function displayLogin(): Response
    {
        echo 'Display login form';

        prettyPrint($this->request->GET);
        echo $this->request->method, '<br/>';
        echo $this->request->path, '<br/>';

        return new Response(200, "");
    }

    public function login(): Response
    {
        echo 'Logging in...';

        prettyPrint($this->request->POST);
        echo $this->request->method, '<br/>';
        echo $this->request->path, '<br/>';

        return new Response(200, "");
    }

    public function displaySignup(): Response
    {
        echo 'Display sign up form';

        prettyPrint($this->request->GET);
        echo $this->request->method, '<br/>';
        echo $this->request->path, '<br/>';
        
        return new Response(200, "");
    }

    public function signup(): Response
    {
        echo 'Signing up...';

        prettyPrint($this->request->POST);
        echo $this->request->method, '<br/>';
        echo $this->request->path, '<br/>';

        return new Response(200, "");
    }


}