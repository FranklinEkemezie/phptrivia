<?php

declare(strict_types=1);

namespace App\Utils;

class MessageFlasher
{

    private static function getFlashMessages(): array
    {
        $flashMessages = Session::get('flash_messages');

        return is_array($flashMessages) ? $flashMessages : [];
    }

    /**
     * Checks whether a message can be flashed in a given route
     */
    public static function canMessageFlash(string $name, $route): bool
    {
        $flashMessages = self::getFlashMessages();

        $routes = $flashMessages[$name]['routes'];
        if (
            // routes allowed is a string
            (is_string($routes) && (        // either
                $routes === '*') ||         // all routes are allowed, or
                $routes === $route          // the particular route is the one allowed
            ) ||

            // routes allowed is an array
            (is_array($routes) && (         // either
                in_array('*', $routes) ||   // all routes are allowed, or
                in_array($route, $routes)   // the route is one the routes allowed
            ))
        ) {
            return true;
        }

        return false;
    }

    /**
     * Register a message flash
     * @param string $name The name (identifier) of the message flash
     * @param string $message The message to flash
     * @param string|array $routes The route(s) in which the message can be flashed.
     * Default is `*` which allows a route to be flashed in all routes.
     * @return void
     */
    public static function register(string $name, string $message, string|array $routes='*')
    {
        $flashMessages = self::getFlashMessages();

        $flash = [
            'routes'        => is_array($routes) ? $routes : [$routes],
            'message'       => $message,
        ];

        Session::set('flash_messages', array_merge(
            $flashMessages,
            [$name => $flash]
        ));
    }

    public static function flash(string $name, string $route, $destroy=true): ?string
    {
        $flashMessages = self::getFlashMessages();
        
        if (
            ($message = $flashMessages[$name]['message'] ?? null) &&
            self::canMessageFlash($name, $route)
        ) {

            if ($destroy) {
                self::unregister($name);
            }

            return $message;
        }

        return null;
    }

    public static function unregister(string $name)
    {
        $flashMessages = self::getFlashMessages();

        unset($flashMessages[$name]);

        Session::set('flash_messages', $flashMessages);
    }


}