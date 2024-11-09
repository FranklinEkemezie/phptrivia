<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Config;
use App\Utils\Request;
use App\Utils\Session;

abstract class BaseController {

    protected Session $session;

    public function __construct(
        protected Request $request,
        protected Config $config
    )
    {
        $this->session = new Session();

    }
}