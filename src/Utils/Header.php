<?php

declare(strict_types=1);

namespace App\Utils;

class Header
{
    private string $host;
    private string $userAgent;
    private array $accept;

    public function __construct(array $header)
    {
        
    }
}