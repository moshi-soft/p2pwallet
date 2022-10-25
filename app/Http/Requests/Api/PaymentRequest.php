<?php

namespace App\Http\Requests\Api;

use App\Contracts\WalletRepositoryInterface;
use App\Repository\WalletRepository;
use App\Rules\WalletBalanceCheck;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'to_user' => ['required'],
            'payment_type' => ['required', Rule::in(explode(',',env('PAYMENT_METHOD')))],
            'amount' =>  ['required', 'numeric',new WalletBalanceCheck(user_id: $this->user()->id,walletRepository: new WalletRepository())],
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->error('Validation Errors',$validator->errors(),422)
        );
    }
}
