<?php

namespace App\Http\Requests\api\Customer\Auth;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class AddAddressRequest extends FormRequest
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
            'address'  => 'required',
            // 'lat'      => 'required|regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/',
            'lat'      => 'required',
            'lng'      => 'required',
            'city_id' => 'nullable|uuid|exists:cities,id',
            'city_name'=> 'nullable|string',
            'country_id'=> 'nullable|uuid|exists:countries,id',
            'country_name'=> 'nullable|string',
            'delivery_instructions'=> 'nullable|string',
        ];
    }

   
}
