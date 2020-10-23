<?php

namespace App\Services;

use App\DTOs\LoginData;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserContract;

class AuthService
{
    /** @var UserContract */
    private $user;

    public function __construct(UserContract $userContract)
    {
        $this->user = $userContract;
    }

    public function login(LoginData $login): array
    {
        if (!Auth::attempt(['email' => $login->email, 'password' => $login->password])) {
            return [
                'error_code' => 400,
                'message' => 'Invalid Credentials. Try again.',
            ];
        }

        $user = $this->user->findByEmail($login->email);

        if (!$user) {
            return [
                'error_code' => 404,
                'message' => 'User not found. Kindly register or contact admin.',
            ];
        }

        try {
            $token = $user->createToken('authToken')->plainTextToken;
        } catch(\Exception $e) {
            return [
                'error_code' => 500,
                'message' => 'Could not process request at this time. Please try again.',
                'details' => [
                    'code' => 'AUTH_500',
                ],
            ];
        }

        return [
            'error_code' => 0,
            'message' => 'Authenticated.',
            'data' => [
                'access_token' => $token,
                'type' => 'Bearer',
            ],
        ];
    }
}