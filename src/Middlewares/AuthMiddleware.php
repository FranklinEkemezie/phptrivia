<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Utils\FlashMessage;
use App\Utils\Redirector;
use App\Utils\Request;
use App\Utils\Response;

class AuthMiddleware extends BaseMiddleware
{

    public function __construct(private array $routes)
    {

    }


    public function handle(Request $request): bool
    {

        $path = $request->path;
        $method = $request->method;

        $authInfo = $this->routes[$path][$method]['auth'] ?? null;
        if (is_null($authInfo)) {
            return false;
        }
        [$authRequired, $authRedirectUrl] = $authInfo;

        // If authentication is required but not provided
        if ($authRequired && ! $request->isAuth()) {
            FlashMessage::flash(new FlashMessage('auth-required', 'Please login to continue', $authRedirectUrl, 'warning'));

            Redirector::redirect($authRedirectUrl);
        }
        // If authentication is not required, but is provided
        else if (! $authRequired && $request->isAuth()) {
            Redirector::redirect($authRedirectUrl);
        }

        return true;
    }
}