<?php

namespace App;
class AppConfig
{
    public const WALLET_ACTION_TYPE_PRIMARY = 'PRIMARY';
    public const WALLET_ACTION_TYPE_ADD = 'ADD';
    public const WALLET_ACTION_TYPE_DEDUCT = 'DEDUCT';
    public const WALLET_ACTION_TYPE_ADJUST = 'ADJUSTMENT';

    public const  WALLET_ACTION_TYPE = [
        self::WALLET_ACTION_TYPE_PRIMARY, self::WALLET_ACTION_TYPE_ADD,
        self::WALLET_ACTION_TYPE_DEDUCT, self::WALLET_ACTION_TYPE_ADJUST
    ];
}
