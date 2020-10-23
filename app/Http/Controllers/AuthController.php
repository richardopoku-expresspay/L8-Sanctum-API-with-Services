<?php

namespace App\Http\Controllers;

use App\DTOs\LoginData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LoginFormRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    /** @var AuthService */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function __invoke(LoginFormRequest $request)
    {
        $result = $this->authService->login(LoginData::fromRequest($request));

        Log::debug('Response from Login', ['response' => $result]);

        return response()->json($result);
    }
}
