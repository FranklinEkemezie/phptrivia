<?php

declare(strict_types=1);

namespace App\Views;

/**
 * @property-read string $name
 */

class Component extends View {

    protected const INCLUDE_DIR = COMPONENTS_FOLDER;


    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \Exception('Cannot access non-existing property ' . __CLASS__ . '::$' . $name);
    }
}