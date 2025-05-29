<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthRepository implements AuthInterface
{
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return [];
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        //Session::put('user_id',$user->id);

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            Session::forget('user_id');
            $user->currentAccessToken()->delete();
            return true;
        }
        return false;
    }

    public function checkAuth(){
        return Auth::user();
    }
}
