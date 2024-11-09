<?php

declare(strict_types=1);

namespace App\Utils;

/**
 * Flash messages between routes
 * 
 */
class FlashMessage
{


    private function __construct()
    {
        
    }

    /**
     * Flash a message across one or more routes
     * @param string $name The name to identify the flash message
     * @param string $message The message to flash
     * @param string|array $routes The route(s) in which to flash the message
     * @param bool $destroyOnFlash Specify whether to destroy the flash message 
     * when flashed across a particular route
     * @return void
     */
    public static function flash(
        string $name,
        string $message,
        string|array $routes
    ): void
    {
        // Store in session
        Session::update('flash_messages', [$name => [
            'name' => $name,
            'message' => $message,
            'routes' => $routes
        ]], true);
    }

    /**
     * Get the flashed messages for the given route
     * @param string $route
     * @param bool $destroyOnFlash Specify whether to destroy the flash message 
     * when flashed across a particular route
     * @return ?array
     */
    public static function getFlashMessages(
        string $route,
        bool $destroyOnFlash=false
    ): ?array
    {
        return array_filter(Session::get('flash_messages'), function($message) use ($route) {
            return is_array($routes = $message['routes']) ?
                in_array($route, $routes) :
                $routes === '*' || $routes === $route
            ;
        });
    }

    public static function getFlashMessage(
        string $name,
        string $route,
        bool $destroyOnFlash=false
    ): ?string
    {
        return (static::getFlashMessages(
            $route,
            $destroyOnFlash
        ))[$name]['message'] ?? null;
    }
}