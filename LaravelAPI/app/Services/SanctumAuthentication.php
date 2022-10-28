<?php

namespace App\Services;

use App\Contracts\AuthenticationInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class SanctumAuthentication implements AuthenticationInterface
{
    /**
     * @throws HttpResponseException
     */
    public function attemptToLogin(array $userCredential):HttpResponseException|string
    {
        if (!Auth::attempt($userCredential)) {
            throw new HttpResponseException(
                response()->error('The provided credential is incorrect.',status: 401)
            );
        }
        return auth()->user()->createToken('API Token')->plainTextToken;
    }

    public function logout():void
    {
        auth()->user()->tokens()->delete();
    }
}
