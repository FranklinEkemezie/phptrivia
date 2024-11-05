<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Utils\Config;
use App\Utils\Request;

abstract class BaseController {


    public function __construct(
        protected Request $request,
        protected Config $config
    )
    {

    }
}