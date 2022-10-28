<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function payableUserList(UserRepositoryInterface $userRepository): array
    {
        return $userRepository->payableUserListWithoutSelf();

    }
}
