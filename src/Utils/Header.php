<?php

declare(strict_types=1);

namespace App\Utils;

class Header
{

    private array $headers;

    // Header option values
    public const CONTENT_TYPE_HTML                  = 'text/html';
    public const CONTENT_CHARSET_UTF_8              = 'UTF-8';
    public const CONTENT_DISPOSITION_ATTTACHMENT    = 'attachment';
    public const CACHE_CONTROL_NO_CACHE             = 'no-cache';


    public function __construct()
    {

        // Set default headers
        $this
            ->setContentType()
            ->disableCaching();
    }

    public function setContentType(
        string $contentType = self::CONTENT_TYPE_HTML,
        string $charSet = self::CONTENT_CHARSET_UTF_8
    ): self
    {
        $this->headers['Content-Type'] = "$contentType;charset=$charSet";

        return $this;
    }

    public function disableCaching(): self
    {
        $this->headers['Cache-Control'] = self::CACHE_CONTROL_NO_CACHE;

        return $this;
    }

    public function send(): void
    {
        foreach($this->headers as $header=>$value) {
            header("$header: $value");
        }
    }
}