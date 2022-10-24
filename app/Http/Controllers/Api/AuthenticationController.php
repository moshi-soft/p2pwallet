<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthenticationInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\AuthenticationResource;

class AuthenticationController extends Controller
{
    protected AuthenticationInterface $authentication;

    public function __construct(AuthenticationInterface $authentication)
    {
        $this->authentication = $authentication;
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authentication->attemptToLogin($request->validated());
        //dd($token);
        $user = (auth()->user())->toArray();
        $user['token'] = $token;
        $user['token_type'] = 'Bearer';
        return new AuthenticationResource($user);
    }

    public function logout(): void
    {
        $this->authentication->logout();
    }
}
