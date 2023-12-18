<?php

namespace App\Contracts\Services;

use App\Models\User;

interface UserAuthInterface
{
    public function registerUser(array $credentials): User;
    public function makeLogin(array $credentials): string; // email, password
    public function makeLogout(User $user): int; // email, password
}
