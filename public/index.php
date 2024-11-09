<?php

declare(strict_types=1);

use App\Controllers\ErrorController;
use App\Core\App;
use App\Core\Router;
use App\Utils\Config;
use App\Utils\EnvManager;
use App\Utils\Logger;
use App\Utils\Request;
use App\Utils\Session;

// Define document root
define('DOCUMENT_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// Include necessary
require DOCUMENT_ROOT . 'bootstrap' . DIRECTORY_SEPARATOR . 'constants.php';
require BOOTSTRAP_FOLDER . 'helpers.php';
require BOOTSTRAP_FOLDER . 'autoloader.php';

// Start session
Session::init();

// Load the environment variables
EnvManager::loadEnv(DOCUMENT_ROOT . '.env');

// Set up application
$routes     = getJSONFromFile(APP_ROOT . 'routes.json');

$router     = new Router();
$request    = new Request();
$config     = new Config($_ENV);
$logger     = new Logger();

// Run the application
try {
    $response = (new App($router, $config))
        ->run($routes, $request);

    echo $response;

    // prettyPrint($response->getResponseBody());
} catch (\Throwable $e) {

    $error = <<<LOG
    Message:    {$e->getMessage()}
    Code:       {$e->getCode()}
    File:       {$e->getFile()}:{$e->getLine()}
    Trace:      {$e->getTraceAsString()}
    LOG;
    
    // Log the error for now
    file_put_contents(LOGS_DIR . 'error.log',$error);

    echo ErrorController::internalError();
}
