<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResource;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthServices $authService;

    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }
    public function login(Request $request)
    {
        $credentials = $request->only('identification', 'password');

        $result = $this->authService->login($credentials);

        if (empty($result)) {
            return ApiResource::error('Identification and/or password is incorrect', 401);
        }

        return ApiResource::success($result, 'Login successful', 200);
    }

    public function logout()
    {
        $result = $this->authService->logout();

        if (!$result) {
            return ApiResource::error('Logout failed', 500);
        }

        return ApiResource::success([], 'Logout successful', 200);
    }

    public function checkToken()
    {
        $check = $this->authService->checkAuth();

        if ($check) {
            return ApiResource::error('Invalid', 401);
        }
        return ApiResource::success([], 'Valid', 200);
    }
}
