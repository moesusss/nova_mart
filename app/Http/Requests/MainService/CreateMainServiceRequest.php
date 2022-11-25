<?php

namespace App\Http\Requests\MainService;

use Illuminate\Foundation\Http\FormRequest;

class CreateMainServiceRequest extends FormRequest
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
            'code' => 'required|unique:main_services,code,NULL,id,deleted_at,NULL',
            'name' => 'required|unique:main_services,name,NULL,id,deleted_at,NULL'
        ];
    }
}
