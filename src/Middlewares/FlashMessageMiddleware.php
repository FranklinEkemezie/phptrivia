<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Utils\FlashMessage;
use App\Utils\Request;
use App\Utils\Response;

class FlashMessageMiddleware extends BaseMiddleware
{

    public function __construct(
        private Response $response
    )
    {

    }

    public function handle(Request $request): Response
    {
        return (clone $this->response)
            ->setFlashMessages(
                // [
                //     new FlashMessage('message', 'Welcome from PHPTrivia Middleware!', '/'),
                //     new FlashMessage('message-01', 'Welcome to this page', '*'),
                //     new FlashMessage('x', 'Registration not successful', '/login', 'danger'),
                //     new FlashMessage('x', 'Account created', '/login', 'success')
                // ]
                FlashMessage::getFlashMessages($request->path)
            )
        ;
    }
}