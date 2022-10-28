<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function payableUserListWithoutSelf():array;

    public function getUser();


}
