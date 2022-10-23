<?php

namespace App\Contracts\AuthInterface;


interface AccessTokenInterface
{
    public function createToken():string;

    public function deleteToken();

}
