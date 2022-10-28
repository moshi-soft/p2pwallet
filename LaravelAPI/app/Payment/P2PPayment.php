<?php

namespace App\Payment;

use App\Contracts\PayableMethodInterface;
use App\Contracts\WalletRepositoryInterface;
use App\Repository\WalletRepository;

class P2PPayment implements PayableMethodInterface
{
    public WalletRepositoryInterface $walletRepository;
//    public function payFrom(int $from, int $to, float $amount, string $currency, string $action_type)
//    {
//        // TODO: Implement payFrom() method.
//    }
//
//    public function payTo(int $from, int $to, float $convertedAmount, string $currency, string $action_type)
//    {
//        return 'ok';
//        // TODO: Implement makePayment() method.
//    }
    public function __construct()
    {
        $this->walletRepository = new WalletRepository();
    }

    public function pay(int $from, int $to, float $amount, float $converted_amount)
    {
        $this->walletRepository->addToWallet($to, $converted_amount);
        $this->walletRepository->deductFromWallet($from, $amount);
    }
}
