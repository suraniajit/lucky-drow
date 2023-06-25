<?php

namespace Modules\Balance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DepositRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'deposit_user_id'   =>  'required',
            'deposit_amount'    =>  'required',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'          =>  'User Required',
            'deposit_amount.required'   =>  'Deposit Amount Required',
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
