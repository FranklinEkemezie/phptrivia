<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\FlashMessage;
use App\Utils\RequestPortal;
use App\Utils\Response;
use App\Views\Component;
use App\Views\Layout;
use App\Views\View;

class HomeController extends BaseController
{

    public function index(): Response
    {
        // Flash a welcome message
        FlashMessage::flash(new FlashMessage('welcome', 'Welcome to PHPTrivia!', '/'));

        // Get the signup error
        $signupError = (RequestPortal::catch('signup-error', $this->request->path)) ?? [];

        return new Response(200, 
            (new View('index', layout: new Layout('layout', placeholderValues: ['title' => 'Welcome'])))
                ->useComponent(new Component('signup-modal', placeholderValues: $signupError))
        );
    }
}