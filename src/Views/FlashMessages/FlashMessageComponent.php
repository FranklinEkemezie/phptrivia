<?php

declare(strict_types=1);

namespace App\Views\FlashMessages;

use App\Utils\FlashMessage;
use App\Views\Component;

class FlashMessageComponent extends Component
{
    protected const INCLUDE_DIR = COMPONENTS_FOLDER . 'flash_messages' . DIRECTORY_SEPARATOR;


    public static function createFromFlashMessage(FlashMessage $flashMessage): FlashMessageComponent
    {
        return new self(
            $flashMessage->template,
            $flashMessage->name,
            null,
            ['message' => $flashMessage->message]
        );
    }

}