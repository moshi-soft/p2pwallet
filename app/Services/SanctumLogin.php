<?php

namespace App\Services;

use App\Contracts\AuthInterface\AccessTokenInterface;
use App\Contracts\AuthInterface\LoginInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SanctumLogin implements LoginInterface,AccessTokenInterface
{
    /**
     * @throws ValidationException
     */
    public function attempt($userCredential): bool
    {
        if (!Auth::attempt($userCredential)) {
            throw ValidationException::withMessages([
                'error' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    public function createToken(): string
    {
        return auth()->user()->createToken('API Token')->plainTextToken;
    }

    public function deleteToken():void
    {
        // TODO: Implement deleteToken() method.
    }
}
