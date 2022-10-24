<?php

namespace App\Contracts;

interface AuthenticationInterface
{
    public function attemptToLogin(array $userCredential);

    public function logout(): void;

}
