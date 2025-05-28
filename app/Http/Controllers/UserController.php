<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserServices $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->userServices=$userServices;
    }
    public function store(UserRequest $user){
        return $this->userServices->create($user->validated());

    }

    public function show(int $id){
        return $this->userServices->findUserById($id);
    }
}
