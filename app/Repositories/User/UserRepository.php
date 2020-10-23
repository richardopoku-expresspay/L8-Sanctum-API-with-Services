<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserContract 
{
    public function findByEmail(string $email) 
    {
        return User::where('email', $email)->first();
    }

    public function all()
    {
        return User::all();
    }
}