<?php

declare(strict_types=1);

use App\Core\App;
use App\Core\Router;
use App\Utils\Config;
use App\Utils\EnvManager;
use App\Utils\Request;

// Define document root
define('DOCUMENT_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// Include necessary files
require DOCUMENT_ROOT       . 'bootstrap' . DIRECTORY_SEPARATOR . 'constants.php';
require BOOTSTRAP_FOLDER    . 'helpers.php';
require BOOTSTRAP_FOLDER    . 'autoloader.php';


// Load the environment variables
EnvManager::loadEnv(DOCUMENT_ROOT . '.env');


// Set up application
$routes     = getJSONFromFile(APP_ROOT . 'routes.json');

$router     = new Router();
$request    = new Request($_SERVER);
$config     = new Config($_ENV);

// Run the application
echo (new App($router, $config))
    ->run($routes, $request);