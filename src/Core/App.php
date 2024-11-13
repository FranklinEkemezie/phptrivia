<?php

declare(strict_types=1);

namespace App\Core;

use App\Exceptions\ControllerException;
use App\Middlewares\FlashMessageMiddleware;
use App\Utils\Config;
use App\Utils\FlashMessage;
use App\Utils\Request;
use App\Utils\Response;
use App\Views\FlashMessageComponent;
use App\Views\View;

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
            ->route($request, $this->config);

        // Get the response
        try {
            /** @var Response $response */
            $response = $routeHandler();
        } catch(\App\Exceptions\DBException $e) {
            throw new \App\Exceptions\DBException($e->getMessage(), (int) $e->getCode());
        } catch (\Exception $e) {
            throw new ControllerException($e->getMessage(), (int) $e->getCode());
        }
        
        // Hande authentication


        // Handle flash message
        $response = (new FlashMessageMiddleware($response))
            ->handle($request);

        return $response;
    }
}