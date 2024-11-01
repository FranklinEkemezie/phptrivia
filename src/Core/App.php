<?php

declare(strict_types=1);

namespace App\Core;

use App\Controllers\ErrorController;
use App\Exceptions\ControllerException;
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
        // Get the Controller method handler for the request
        $routeHandler = $this->router->register($routes)
            ->route($request);

        try {
            return $routeHandler();
        } catch (\Exception $e) {
            throw new ControllerException($e->getMessage(), (int) $e->getCode());
        }
    }
}