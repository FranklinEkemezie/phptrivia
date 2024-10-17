<?php

declare(strict_types=1);

namespace App\Utils;

class Response
{

    private string $statusLine;
    private int $statusCode;
    private Header $header;
    private ?string $body;


    public function __tostring()
    {
        return '';
    }
}