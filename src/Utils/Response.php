<?php

declare(strict_types=1);

namespace App\Utils;

use App\Views\View;

class Response
{

    

    public function __construct(
        private int $statusCode,
        private string|View $body,
        private ?Header $header=null
    )
    {
        if ($header === null) {
            $this->header = new Header();
        }

    }

    public function send(): string
    {
        http_response_code($this->statusCode);

        // Send headers
        $this->header->send();

        // Return the response
        return (string) $this->body;
    }

    public function __toString()
    {
        return $this->send();
    }

}