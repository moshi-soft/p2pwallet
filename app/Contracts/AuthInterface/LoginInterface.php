<?php

namespace App\Contracts\AuthInterface;

use Illuminate\Http\Request;

interface LoginInterface
{
    public function attempt(array $userCredential):bool;

}
