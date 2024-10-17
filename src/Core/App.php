<?php

declare(strict_types=1);

namespace App\Core;

use App\Utils\Config;
use App\Utils\Request;
use App\Utils\Response;

class App
{

    public function __construct(
        private Router $router,
        private Config $config
    )
    {

    }


    public function run(array $routes, Request $request): Response
    {
        $routeHandler = $this->router->register($routes)
            ->route($request);
        if ($routeHandler === null) {
            return new Response();
        }

        return $routeHandler();
    }
}