<?php

namespace App\Services;

use App\Contracts\ExchangeRateHistoryRepositoryInterface;
use App\Contracts\ExchangeRateInterface;
use App\Contracts\PaymentInterface;
use Carbon\Carbon;
use http\Exception\BadHeaderException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ExchangeRateService implements ExchangeRateInterface
{


    public function checkRate($amount, $from_currency, $to_currency)
    {
        //dd(Carbon::today()->format('Y-m-d'));
        // return response()->error(message: 'User wallet Invalid', status: 400);

        $response = Http::getExchangeRate(['to' => $to_currency, 'from' => $from_currency, 'amount' => $amount]);

        /*
         * Error will be managed later
         * */
        if ($response->failed()) {
            throw new HttpResponseException(
                response()->error(message: 'Something wrong happened bad request exception', status: $response->status)
            );
        }

        if ($response->clientError()) {
            throw new HttpResponseException(
                response()->error(message: 'Client Error Occurred', status: $response->status)
            );
        }

        if ($response->serverError()) {
            throw new HttpResponseException(
                response()->error(message: 'Unknown Error Occurred', status: $response->status)
            );
        }
        if ($response->successful()) {
            return $response->json();
        }
        //dd($response->json());
    }
}
