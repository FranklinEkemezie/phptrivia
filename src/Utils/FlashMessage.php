<?php

declare(strict_types=1);

namespace App\Utils;

use App\Utils\Session;

/**
 * Flash messages between routes
 * 
 */
class FlashMessage
{

    public const SESSION_NAME = 'flash_messages';

    public function __construct(
        private string $name,
        private string $message,
        private string|array $routes,
        private string $template='message'
    )
    {
        
    }

    /**
     * Flash a message across one or more routes
     * @param FlashMessage $flashMessage
     * @return void
     */
    public static function flash(FlashMessage $flashMessage): void
    {
        // Store in session
        Session::update(
            self::SESSION_NAME,
            [$flashMessage->name => $flashMessage],
            true
        );

    }

    /**
     * Get the flashed messages for the given route
     * @param string $route
     * @param bool $destroyOnFlash Specify whether to destroy the flash message 
     * when flashed across a particular route
     * @return FlashMessage[]
     */
    public static function getFlashMessages(
        string $route
    ): ?array
    {

        /**
         * @var FlashMessage[] $flashMessagesPrev
         */
        $flashMessagesPrev = Session::get(self::SESSION_NAME);
        $flashMessagesNext = [];
        $flashMessages = [];

        foreach($flashMessagesPrev as $name => $message) {
            if (static::shouldFlash($message, $route))
                $flashMessages[$name] = $message;
            else
                $flashMessagesNext[$name] = $message;
        }

        // Update session
        Session::set(self::SESSION_NAME, $flashMessagesNext);

        return $flashMessages;
    }

    public static function shouldFlash(FlashMessage $flashMessage, string $route): bool
    {
        return is_array($routes = $flashMessage->routes) ?
            in_array($route, $routes) :
            ($routes === '*' || $routes === $route)
        ;
    }

    public static function getFlashMessage(string $name, string $route): ?string
    {
        return (static::getFlashMessages(
            $route
        ))[$name]->message ?? null;
    }

    public function __get(string $name): mixed
    {
        if (! property_exists($this, $name)) {
            throw new \Exception('Cannot access non-existing property ' . __CLASS__ . '::$' . $name);
        }

        return $this->$name;
    }
}