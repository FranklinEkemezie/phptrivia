<?php

declare(strict_types=1);

namespace App\Utils;

/**
 * Move data around HTTP Request portals
 */
class RequestPortal
{

    private const SESSION_NAME = 'black_holes';


    public static function throw(string $name, mixed $value, string $portal): void
    {
        $items = Session::get(static::SESSION_NAME) ?? [];
        $itemsInPortal = $items[$portal] ?? [];

        // Update the values
        $itemsInPortal[$name] = $value;
        $items[$portal] = $itemsInPortal;

        // Set session
        Session::set(static::SESSION_NAME, $items);
    }

    public static function catch(string $name, string $portal): mixed
    {

        $blackHoleItems = Session::get(static::SESSION_NAME) ?? [];

        $item = $blackHoleItems[$portal][$name] ?? null;

        unset($blackHoleItems[$portal][$name]);

        Session::set(static::SESSION_NAME, $blackHoleItems);

        return $item;

    }
}