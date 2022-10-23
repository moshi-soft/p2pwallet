<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthInterface\LoginInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginInterface $login)
    {
        $login->attempt($request->validated());
    }
}
