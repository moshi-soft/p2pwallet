<?php

namespace App\Repository;

use App\AppConfig;
use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function payableUserListWithoutSelf(): array
    {
        return User::all()->except(auth()->id())?->toArray();
    }

    public function getUser()
    {
        // TODO: Implement getUser() method.
    }
}
