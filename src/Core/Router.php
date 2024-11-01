<?php

declare(strict_types=1);

namespace App\Core;

use App\Controllers\ErrorController;
use App\Utils\Request;

class Router
{

    private array $routes;

    public function __construct()
    {
        $this->routes = [];
    }


    public function register(array $routes): self
    {
        $this->routes  =
            array_merge_recursive($this->routes, $routes);

        return $this;
    }

    private static function getRouteRegex(string $route, array $routeInfo): string
    {
        $params = $routeInfo['params'] ?? [];
        
        $searchArr = array_map(function($item) {
            return ":$item";
        }, array_keys($params));
        $replaceArr = array_map(function($item) {
            return match($item) {
                'number'    => '\d+',
                'string'    => '\w+',
                default     => '\w+'
            };
        }, array_values($params));

        $routeRegex = str_replace($searchArr, $replaceArr, $route);

        return "@^$routeRegex$@";
    }

    public function route(Request $request): callable
    {

        foreach($this->routes as $route => $routeMethods) {
            foreach($routeMethods as $method => $routeInfo) {
                if (preg_match(
                    self::getRouteRegex($route, $routeInfo), 
                    $request->path)
                ) {

                    $controllerNamespace = 'App\\Controllers\\';
                    $controller = $controllerNamespace . $routeInfo['controller'] . 'Controller';
                    $method = $routeInfo['handler'] ?? 'index';

                    $controllerInstance = new $controller($request);

                    return function() use ($controllerInstance, $method){
                        return call_user_func_array([$controllerInstance, $method], []);
                    };
                }
            }
            
        }

        return [ErrorController::class, 'notFound'];
    }
}