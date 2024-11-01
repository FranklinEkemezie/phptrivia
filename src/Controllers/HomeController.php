<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Response;
use App\Views\Component;
use App\Views\View;

class HomeController extends BaseController
{

    public function index(): Response
    {        

        return new Response(
            200,
            (new View('index'))
                ->useComponent('header')
                ->useComponent('footer')
                ->useComponent('signup-modal', null, [
                    'username_field'        => 'username',
                    'email_field'           => 'email',
                    'experience_level_field'=> 'experience_level'
                ], false)
                ->setPlaceholderValues([])
            )
        ;
    }
}

// [
//     'username'          => 'username',
//     'email'             => 'email',
//     'experience_level'  => 'experience-level'
// ]