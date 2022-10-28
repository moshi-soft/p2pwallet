<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ExchangeRateHistoryRepositoryInterface;
use App\Contracts\ExchangeRateInterface;
use App\Contracts\NotifiableInterface;
use App\Contracts\PaymentInterface;
use App\Contracts\TransactionHistoryRepositoryInterface;
use App\Contracts\WalletRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentRequest;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function pay(
        PaymentRequest                         $paymentRequest,
        NotifiableInterface                    $notifiable,
        PaymentInterface                       $payment,
        ExchangeRateInterface                  $exchangeRate,
        ExchangeRateHistoryRepositoryInterface $exchangeRateRepository,
        WalletRepositoryInterface              $walletRepository,
        TransactionHistoryRepositoryInterface  $transactionHistoryRepository
    )
    {
//        dd(auth()->user()['name']);
        $input = $paymentRequest->validated();
        $senderWallet = $walletRepository->getWallet(auth()->id());
        $receiverWallet = $walletRepository->getWallet($input['to_user']);
        if (is_null($senderWallet) || is_null($receiverWallet)) {
            return response()->error(message: 'User wallet Invalid', status: 400);
        }
        try {
            $response = $exchangeRate->checkRate($input['amount'], $senderWallet->currency, $receiverWallet->currency);
            DB::beginTransaction();
            $exchangeRateRepository->create($response['date'], $response['info']['rate'], $response['query']['amount'],
                $response['result'], $response['query']['from'], $response['query']['to'], $response['info']['timestamp'],
                $response['success'], $response);

            $paymentMethod = $payment->init($input['payment_type']);
            $paymentMethod->pay(auth()->id(), $receiverWallet->id, $response['query']['amount'], $response['result']);
            $transactionHistoryRepository->create(auth()->id(), $receiverWallet->id, $response['query']['from'], $response['query']['to'], $response['info']['rate'], $response['query']['amount'], $response['result']);
            // Notify through email
            $notifiable->notifyViaEmail($receiverWallet['email'],'Payment Received',[
                'amount'=>$response['result'],
                'currency'=>$response['query']['to'],
                'fromName'=>auth()->user()['name'],
                'fromEmail'=>auth()->user()['email']
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->error(message: $e->getMessage());
        }
        return response()->success([
            'Message with converted rate and current balance'
        ], 200);
       // dd($exchangeRate);
    }
}
