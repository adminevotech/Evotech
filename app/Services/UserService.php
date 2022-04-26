<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function createUser($request)
    {
        $user = User::create($request->validated());
        return $user;               
    }

    public function updateUser($request, $user)
    {
        $user->update($request->validated());
        return $user;             
    }
}
