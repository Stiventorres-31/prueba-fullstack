<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface
{
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return [];
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        $cookies = cookie(
            'auth_token',   // Nombre
            $token,         // Valor
            5,         // Tiempo de vida en minutos (30 días)
            null,          // Path (toda la aplicación)
            null,          // Dominio
            true,          // Secure (solo HTTPS)
            true,          // HTTP Only
            false,         // SameSite (puede ser 'strict' o 'lax')
            'None'
        );
        return response([
            'user' => $user,
            'token' => $token
        ])->withCookie($cookies);
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $user->currentAccessToken()->delete();
            return true;
        }
        return false;
    }
}
