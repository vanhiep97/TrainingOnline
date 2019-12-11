<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        return response()->json($this->authService->login([
            'email'    => $request->email,
            'password' => $request->password,
        ]));
    }

    public function logout(Request $request)
    {
        return response()->json($this->authService->logout($request->header('Authorization')));
    }
}
