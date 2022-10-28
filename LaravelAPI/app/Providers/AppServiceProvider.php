<?php

namespace App\Providers;

use App\Contracts\AuthenticationInterface;
use App\Contracts\ExchangeRateHistoryRepositoryInterface;
use App\Contracts\ExchangeRateInterface;
use App\Contracts\NotifiableInterface;
use App\Contracts\PaymentInterface;
use App\Contracts\ReportInterface;
use App\Contracts\TransactionHistoryRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\WalletHistoryRepositoryInterface;
use App\Contracts\WalletRepositoryInterface;
use App\Repository\ExchangeRateHistoryRepository;
use App\Repository\TransactionHistoryRepository;
use App\Repository\UserRepository;
use App\Repository\WalletHistoryRepository;
use App\Repository\WalletRepository;
use App\Services\ExchangeRateService;
use App\Services\NotifiableService;
use App\Services\PaymentService;
use App\Services\ReportService;
use App\Services\SanctumAuthentication;
use Illuminate\Support\Facades\Http;
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
        $this->app->bind(ReportInterface::class, ReportService::class);
        // repository
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(WalletRepositoryInterface::class, WalletRepository::class);
        $this->app->bind(WalletHistoryRepositoryInterface::class, WalletHistoryRepository::class);
        $this->app->bind(TransactionHistoryRepositoryInterface::class, TransactionHistoryRepository::class);
        $this->app->bind(ExchangeRateHistoryRepositoryInterface::class, ExchangeRateHistoryRepository::class);
//        $this->app->bind(TokenInterface::class, SanctumToken::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('DEFAULT_EXCHANGE_RATE_SERVICE_MACRO') == 'fixerio') {
            Http::macro('getExchangeRate', function (array $body = []) {

                return Http::withHeaders([
                    'Content-Type' => 'text/plain',
                    'apikey' => env('FIXER_EXCHANGE_RATE_API_KEY')
                ])->get('https://api.apilayer.com/fixer/convert', $body);
            });
        }
    }
}
