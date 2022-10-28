<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface WalletHistoryRepositoryInterface
{
    public function create();

    public function listByUser();

    public function list();

    public function detail($id);
}
