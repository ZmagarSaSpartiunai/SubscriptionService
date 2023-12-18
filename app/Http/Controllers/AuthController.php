<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserAuthInterface;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private UserAuthInterface $authService;

    public function __construct(UserAuthInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param RegisterRequest $request
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        return $this->authService->registerUser($request->input());
    }

    /**
     * @param AuthRequest $request
     * @param AuthServiceInterface $authService
     * @return Application|ResponseFactory|Response
     * @throws \Illuminate\Validation\ValidationException
     * @throws AuthenticationException
     */
    public function login(AuthRequest $request, UserAuthInterface $authService)
    {
        $token = $authService->makeLogin($request->input());

        return response(['token' => $token], 200)->withCookie(cookie('token', $token));
    }

    /**
     * @return string
     */
    public function logout(): string
    {
        return $this->authService->makeLogout(auth()->user());
    }
}
