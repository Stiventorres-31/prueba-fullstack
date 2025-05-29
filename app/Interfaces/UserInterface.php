<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getAll();
    public function save(array $user);
    public function findById(int $id);
    public function update(int $id, array $user);
    public function delete(int $id);
}
