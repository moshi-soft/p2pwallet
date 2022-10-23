<?php

namespace App\Contracts\AuthInterface;

use Illuminate\Http\Request;

interface LogoutInterface
{
    public function logout(Request $request);

}
