<?php

namespace App\Providers;

use App\Contracts\AuthenticationInterface;
use App\Contracts\ExchangeRateInterface;
use App\Contracts\NotifiableInterface;
use App\Contracts\PaymentInterface;
use App\Services\ExchangeRateService;
use App\Services\NotifiableService;
use App\Services\PaymentService;
use App\Services\SanctumAuthentication;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthenticationInterface::class, SanctumAuthentication::class);
        $this->app->bind(PaymentInterface::class, PaymentService::class);
        $this->app->bind(NotifiableInterface::class, NotifiableService::class);
        $this->app->bind(ExchangeRateInterface::class, ExchangeRateService::class);
//        $this->app->bind(TokenInterface::class, SanctumToken::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
