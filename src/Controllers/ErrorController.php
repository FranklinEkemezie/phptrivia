<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Response;
use App\Views\View;

class ErrorController
{
    
    public static function notFound(): Response
    {
        echo $_SERVER['REQUEST_URI'];
        return new Response(
            404,
            (new View('error/404'))
                ->useComponent('header')
                ->useComponent('footer')
    );
    }

    public static function internalError(): Response
    {
        return new Response(
            500,
            (new View('error/500'))
                ->useComponent('header')
                ->useComponent('footer')
        );
    }
}