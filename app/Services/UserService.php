<?php 

namespace App\Services;

use App\Models\User;

class UserService
{
    public function updateUser($user, $data)
    {
        $user->name = $data['name'];
        $user->email = $data['email'];

        return $user->update();
    }
}