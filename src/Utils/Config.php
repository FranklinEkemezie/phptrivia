<?php

declare(strict_types=1);

namespace App\Utils;

/**
 * @property-read array $db
 */

class Config
{
    private array $config;

    public function __construct(array $env)
    {
        // Get the database configurations
        $this->config['db'] = [
            'driver'    => $env['DB_DRIVER'],
            'host'      => $env['DB_HOST'],
            'user'      => $env['DB_USER'],
            'password'  => $env['DB_PASS'],
            'database'  => $env['DB_DATABASE']
        ];
    
    }


    public function __get(string $name): mixed
    {
        if (key_exists($name, $this->config)) {
            return $this->config[$name];
        }

        throw new \Exception('Cannot access non-existing property ' . __CLASS__ . '::$' . $name);
    
    }


}