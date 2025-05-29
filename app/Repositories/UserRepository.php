<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function save(array $user)
    {
        return User::create($user);
    }
    public function findById(int $id)
    {
        return User::find($id);
    }
    public function getAll()
    {
        return User::all();
    }
    public function update(int $id, array $user)
    {
        $userModel = User::find($id);

        if ($userModel) {
            if (empty($user['password'])) {
                unset($user['password']);
            }
            $userModel->update($user);
            return $userModel;
        }
        return [];
    }
    public function delete(int $id)
    {
        $userModel = User::find($id);
        if ($userModel) {
            return $userModel->delete();
        }
        return false;
    }
}
