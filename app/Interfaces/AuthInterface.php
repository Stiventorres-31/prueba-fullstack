<?php

namespace App\Interfaces;

interface AuthInterface
{
    public function login(array $credentials);
    public function logout();
}
