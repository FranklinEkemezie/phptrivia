<?php

declare(strict_types=1);

namespace App\Utils;

/**
 * Redirect URLs
 */
class Redirector
{

    public static function redirect(string $destinationUrl)
    {
        (new Header())
            ->setHeaders([
                'location' => $destinationUrl
            ])
            ->send();

        exit;
    }


    public function __invoke(...$args)
    {
        call_user_func_array([self::class, 'redirect'], $args);
    }
}