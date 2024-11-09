<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\FlashMessage;
use App\Utils\Response;
use App\Views\Component;
use App\Views\Layout;
use App\Views\View;

class HomeController extends BaseController
{

    public function index(): Response
    {
        // Flash a welcome message
        FlashMessage::flash('welcome', 'Welcome to PHPTrivia! - HomeController', '/');

        return new Response(
            200,
            (new View(
                'index_',
                'index',
                new Layout('layout', placeholderValues: ['title' => 'Welcome']),
                ['hello' => 'Hello, world!'],
            ))->useComponent(new Component('signup-modal', placeholderValues: [
                'username_field' => 'username',
                'email_field' => 'email',
                'experience_level_field' => 'experience_level'
            ]))
        );
    }
}