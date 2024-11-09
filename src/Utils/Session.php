<?php

declare(strict_types=1);

namespace App\Utils;

class Session
{

    public static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public static function set(string $key, mixed $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function update(string $key, array $value, bool $initialiseIfEmpty=false)
    {
        if (! is_array($_SESSION[$key] ?? null)) {
            if ($initialiseIfEmpty)
                static::set($key, []);
            else
                throw new \Exception("Session with key: '$key' does not exist or not an array");
        }

        static::set(
            $key,
            array_merge($_SESSION[$key], $value)
        );
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): bool
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);

            return true;
        }

        return false;
    }

    public static function clear()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
}