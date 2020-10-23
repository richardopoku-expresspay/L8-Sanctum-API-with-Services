<?php

namespace App\Repositories\User;


interface UserContract 
{
    public function findByEmail(string $email);
}