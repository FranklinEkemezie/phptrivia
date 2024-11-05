<?php

declare(strict_types=1);

namespace App\Utils;

abstract class FormValidator
{

    public static function sanitiseData(string $data): string
    {
        return htmlspecialchars(
            stripslashes(
                trim(
                    $data
                )
            )
        );
    }

    private static function getValidationErrorInfo(
        string $validationType,
        string $message
    ): array
    {
        return [
            'validationType'=> $validationType,
            'error'         => true,
            'message'       => $message
        ];
    }

    private static function getValidationSuccessInfo(string $validationType): array
    {
        return [
            'validationType'=> $validationType,
            'error'         => false,
            'message'       => ''
        ];
    }

    public static function validateUsername(string &$username): array
    {
        $username = self::sanitiseData($username);
        $validationType = 'username';

        if (! $username) {
            return self::getValidationErrorInfo(
                $validationType,
                'Username cannot be empty'
            );
        }

        if (! (strlen($username) <= 20)) {
            return self::getValidationErrorInfo(
                $validationType,
                'Username is too long'
            );
        }

        return self::getValidationSuccessInfo($validationType);
    }

    public static function validateEmail(string &$email): array
    {
        if (! ($email = filter_var($email, FILTER_SANITIZE_EMAIL))) {
            return self::getValidationErrorInfo('email', 'Invalid email address');
        };

        return self::getValidationSuccessInfo('email');
    }

    public static function validateExperienceLevel(int &$experienceLevel): array
    {
        if ($experienceLevel < 1|| $experienceLevel > 3) {
            return self::getValidationErrorInfo('experience-level', 'Invalid experience level');
        }

        return self::getValidationSuccessInfo('experience-level');
    }
}