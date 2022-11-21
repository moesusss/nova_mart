<?php

namespace App\Http\Requests\Artist;

use Illuminate\Foundation\Http\FormRequest;

class CreateArtistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:artists,name',
            'mm_name' => 'required|string|unique:artists,mm_name',
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mm_name.required' => 'Myanmar name is required',
        ];
    }
}