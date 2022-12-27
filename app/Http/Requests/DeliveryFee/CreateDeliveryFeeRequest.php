<?php

namespace App\Http\Requests\DeliveryFee;

use App\Rules\CheckFromRange;
use Illuminate\Foundation\Http\FormRequest;

class CreateDeliveryFeeRequest extends FormRequest
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
            'delivery_type' => 'required|string',
            'from' =>  [
                'required',
                new CheckFromRange(request()->to,request()->delivery_type)
            ],
            'to' => [
                'required',
                new CheckFromRange(request()->from,request()->delivery_type)
            ],
            'amount' => 'required',
        ];
    }
}
