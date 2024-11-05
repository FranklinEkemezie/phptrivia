<?php

declare(strict_types=1);

namespace App\Models;

use App\Entities\User;

class UserModel extends BaseModel
{


    public function register(User $user): int
    {
        
        return $this->db->insert('users', [
            'uid'       => $user->uid,
            'username'  => $user->username,
            'email'     => $user->email,
            'experience_level'=> $user->experienceLevel
        ]);

    }
}