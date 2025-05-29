<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResource as HelpersApiResource;
use App\Http\Requests\UsersRequest\UserCreateRequest;
use App\Http\Requests\UsersRequest\UserUpdateRequest;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserServices $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->userServices=$userServices;
    }

    public function index(){

        $users=$this->userServices->getAllUsers();
        if($users->isEmpty()){
            return HelpersApiResource::error('No users found', 404);
        }
        return HelpersApiResource::success($users, 'Users retrieved successfully', 200);
    }
    public function store(UserCreateRequest $user){
        $user=$this->userServices->create($user->validated());
        return HelpersApiResource::success($user, 'User created successfully', 201);
    }

    public function show(int $id){
        $user=$this->userServices->findUserById($id);
        if(!$user){
            return HelpersApiResource::error('User not found', 404);
        }
        return HelpersApiResource::success($user, 'User retrieved successfully', 200);
    }

    public function update(UserUpdateRequest $user, int $id){
        $updatedUser = $this->userServices->updateUser($id, $user->validated());
        if (!$updatedUser) {
            return HelpersApiResource::error('User not found or could not be updated', 404);
        }
        return HelpersApiResource::success($updatedUser, 'User updated successfully', 200);
    }
    public function destroy(int $id){
        $user= $this->userServices->deleteUser($id);
        if(!$user){
            return HelpersApiResource::error('User not found or could not be deleted', 404);
        }
        return HelpersApiResource::success([], 'User deleted successfully', 200);
    }


}
