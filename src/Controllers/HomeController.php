<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Response;

class HomeController extends BaseController
{

    public function index(): Response
    {
        echo 'Rendering index...';

        return new Response;
    }
}