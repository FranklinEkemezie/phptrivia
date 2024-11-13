<?php

declare(strict_types=1);

namespace App\Utils;

use App\Views\FlashMessages\FlashContainer;
use App\Views\FlashMessages\FlashMessageComponent;
use App\Views\View;

class Response
{

    private static $counter = 0;

    public function __construct(
        private int             $statusCode,
        private string|View     $body,
        private ?Header         $header=null,
        private array           $flashMessages=[]
    )
    {

        $this->header ??= new Header;

    }

    private function getFlashContainer(): FlashContainer
    {
        return new FlashContainer('container', 'flash-message', null, [
            'messages' => implode(" ", array_map(
                function (FlashMessage $flashMessage) {
                    return FlashMessageComponent::createFromFlashMessage($flashMessage);
            }, $this->flashMessages))
        ]);
    }

    public function send(): string
    {
        http_response_code($this->statusCode);

        // Get the flash container
        $flashContainer = $this->getFlashContainer();

        if (($body = $this->body) instanceof View && ! is_null($body->layout)) {
            $this->body->layout->useComponent($flashContainer);
        } else {
            $this->body .= (string) $flashContainer;
        }

        // Return the response
        return (string) $this->body;
    }

    public function getResponseBody(): string|View
    {
        return $this->body;
    }

    public function getResponseStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setFlashMessage(FlashMessage $flashMessage): self
    {
        $this->flashMessages[$flashMessage->name] = $flashMessage;

        return $this;
    }

    /**
     * 
     * @param FlashMessage[] $flashMessages
     * @return Response
     */
    public function setFlashMessages(array $flashMessages): self
    {
        foreach ($flashMessages as $message) {
            if (! $message instanceof FlashMessage) {
                throw new \InvalidArgumentException("Parameter #1 must be an array of " . FlashMessage::class);
            }
        }

        $this->flashMessages = array_merge(
            $this->flashMessages,
            $flashMessages
        );

        return $this;
    }

    public function __toString()
    {
        return $this->send();
    }

}