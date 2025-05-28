<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserServices
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $user)
    {
        return $this->userRepository->save($user);
    }

    public function findUserById(int $id){
        return $this->userRepository->findById($id);
    }
}
