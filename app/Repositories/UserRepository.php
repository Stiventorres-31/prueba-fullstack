<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function save(array $user) {
        return User::create($user);
    }
    public function findById(int $id){
        return User::find($id);
    }
}
