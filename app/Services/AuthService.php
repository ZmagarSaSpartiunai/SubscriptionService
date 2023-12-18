<?php

namespace App\Services;

use App\Contracts\Services\UserAuthInterface;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthService implements UserAuthInterface
{
    public function registerUser(array $credentials): User
    {
        return User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ])->fresh();
    }
    /**
     * @param $credentials
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws AuthenticationException
     */
    public function makeLogin(array $credentials): string
    {
        $user = User::where('email', $credentials['email'])->first();

        // check User password
        if (!Hash::check($credentials['password'], $user->password)) {
            abort(403);
        }

        return $user->createToken($user->name, ['user'])->plainTextToken;
    }

    /**
     * @param User $user
     * @return int
     */
    public function makeLogout(User $user): int
    {
        return $user->tokens()->delete();
    }
}
