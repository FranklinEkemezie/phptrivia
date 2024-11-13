<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * @property-read string $uid
 * @property-read string $username
 * @property-read string $email
 * @property-read int $experienceLevel
 */

class User
{

    private string $password;
    private int $experienceLevel;

    public function __construct(
        private string $uid,
        private string $username,
        private string $email,
        string $password,
        int $experienceLevel,
    )
    {
        if (! in_array($experienceLevel, [1, 2, 3])) {
            throw new \InvalidArgumentException("Invalid experience level");
        }

        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->experienceLevel = $experienceLevel;
    }


    public static function getUID(): string
    {
        return bin2hex(random_bytes(16));
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \Exception('Cannont access non-existing property ' . __CLASS__ . '::$' . $name);
    }
}