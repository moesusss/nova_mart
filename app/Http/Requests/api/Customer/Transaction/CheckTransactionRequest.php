<?php

namespace App\Http\Requests\api\Customer\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class CheckTransactionRequest extends FormRequest
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
            'total_amount' => 'required|regex:/^\d{1,14}(\.\d{1,2})?$/',
        ];
    }
}