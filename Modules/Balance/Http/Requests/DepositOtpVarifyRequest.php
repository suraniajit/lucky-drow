<?php

namespace Modules\Balance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class DepositOtpVarifyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'deposit_transaction_no'    =>  'required',
            'deposit_otp'       =>  'required',
        ];
    }
    public function messages(): array
    {
        return [
            'deposit_transaction_no.required'   =>  'transaction_no Required',
            'deposit_otp.required'              =>  'Deposit Otp Required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'    => 'fail',
            'messages'   => $validator->errors(),
        ]));

    }

    public function authorize()
    {
        return true;
    }
}
