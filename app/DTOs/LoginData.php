<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class LoginData 
{
    /** @var string */
    public $email, $password;

    public function __construct(array $properties)
    {
        foreach($properties as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    public static function fromRequest(Request $request) : self
    {
        return new self([
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }
}