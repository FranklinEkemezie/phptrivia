<?php

declare(strict_types=1);

namespace App\Core;

use App\Middlewares\AuthMiddleware;
use App\Middlewares\FlashMessageMiddleware;
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
        $routeHandler = $this->router
            ->register($routes)
            ->route($request, $this->config)
        ;
        
        // Hande authentication
        (new AuthMiddleware($routes))->handle($request);

        // Get the response
        try {

            /** @var Response $response */
            $response = $routeHandler();

        } catch(\App\Exceptions\DBException $e) {
            throw new \App\Exceptions\DBException($e->getMessage(), (int) $e->getCode());
        } catch (\Exception $e) {
            throw new \App\Exceptions\ControllerException($e->getMessage(), (int) $e->getCode());
        }
        
        // Handle flash message
        $response = (new FlashMessageMiddleware($response))->handle($request);

        return $response;
    }
}