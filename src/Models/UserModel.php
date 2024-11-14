<?php

declare(strict_types=1);

namespace App\Models;

use App\Entities\User;

class UserModel extends BaseModel
{

    private static function createUserFrom(array $userInfo, bool $hashPassword=false): User
    {
        return new User(
            $userInfo['uid'],
            $userInfo['username'],
            $userInfo['email'],
            $userInfo['password'],
            (int) $userInfo['experience_level'],
            $hashPassword
        );
    }

    /**
     * Register a user
     * @param \App\Entities\User $user
     * @return int|null|false
     */
    public function register(User $user): int|null|false
    {
        
        return $this->db->insert('users', [
            'uid'       => $user->uid,
            'username'  => $user->username,
            'email'     => $user->email,
            'password'  => $user->password,
            'experience_level' => $user->experienceLevel
        ]);

    }

    public function getUserWith(
        string $uid = null,
        string $username = null,
        string $email = null,
        string $password = null,
        int $experienceLevel = null
    ): ?User
    {

        // Get the user info
        $userInfo = [
            'uid'       => $uid,
            'username'  => $username,
            'email'     => $email,
            'password'  => $password,
            'experience_level' => $experienceLevel
        ];

        // Filter out the fields not given
        $userInfo = array_filter($userInfo, function ($data, $field) {
            return ! is_null($data);
        }, ARRAY_FILTER_USE_BOTH);

        $userSelectInfo =  $this->db->select('users', $userInfo);

        return ! is_null($userSelectInfo) ? 
            static::createUserFrom($userSelectInfo) :
            null
        ;
    }
}