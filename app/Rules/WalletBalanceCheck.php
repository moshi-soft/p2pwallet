<?php

namespace App\Rules;

use App\Contracts\WalletRepositoryInterface;
use App\Repository\WalletRepository;
use Illuminate\Contracts\Validation\InvokableRule;

class WalletBalanceCheck implements InvokableRule
{
    public function __construct(public int $user_id,public WalletRepositoryInterface $walletRepository)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if(!$this->isWalletSufficient($value)){
            $fail('You don\'t have sufficient balance');
        }

    }

    protected function isWalletSufficient($minimum_amount): bool
    {
        return $this->walletRepository->isWalletSufficient($this->user_id,$minimum_amount);
    }
}
