<?php

declare(strict_types=1);

namespace App\Utils;

/**
 * @property-read string $method
 * @property-read string $path
 * @property-read string $httpVersion
 */

class Request
{
    private string $method;
    private string $path;
    private string $httpVersion;
    private Header $header;
    private array $POST;
    private array $GET;

    public const REQUEST_METHODS = ['GET', 'POST'];
    
    public function __construct()
    {
        $this->method       = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $this->path         = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->httpVersion  = $_SERVER['SERVER_PROTOCOL'];

        $this->POST = array_map(function($input) {
            return FormValidator::sanitiseData($input);
        }, $_POST);
        $this->GET = array_map(function($input) {
            return FormValidator::sanitiseData($input);
        }, $_GET);

    }

    public function isAuth(): bool
    {
        return Session::has('user_id');
    }


    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \Exception('Cannot access non-existing property ' . __CLASS__ . '::$' . $name);
    }
}