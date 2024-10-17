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

    public const REQUEST_METHODS = ['GET', 'POST'];
    
    public function __construct(array $serverVariables)
    {
        $this->method       = strtoupper($serverVariables['REQUEST_METHOD'] ?? 'GET');
        $this->path         = $serverVariables['REQUEST_URI'];
        $this->httpVersion  = $serverVariables['SERVER_PROTOCOL'];
    }


    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \Exception('Cannot access non-existing property ' . __CLASS__ . '::$' . $name);
    }
}