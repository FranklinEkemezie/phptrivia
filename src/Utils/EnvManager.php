<?php

declare(strict_types=1);

namespace App\Utils;
use App\Exceptions\NotFoundException;

class EnvManager
{

    public static function loadEnv(string $envPath) {
        if(file_exists($envPath) && 
            pathinfo($envPath)['extension'] === 'env'
        ) {
            // Open the file
            $envFile = fopen($envPath, "r");

            // Read the file one line after the other
            while($line = fgets($envFile)) {

                // Strip the comments off
                $commentStart = strpos($line, '#');
                if ($commentStart === false)
                    $commentStart = strlen($line);

                $line = substr($line, 0, $commentStart);

                // Trim off whitespace
                if (! ($line = trim($line))) continue;

                [$key, $value] = explode('=', $line);

                $_ENV[$key] = $value;
            }

            return '';
        }

        throw new NotFoundException("Could not find the .env file: $envPath");
    }
}