<?php

namespace App\Http\Requests\MainService;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMainServiceRequest extends FormRequest
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
            'code' => 'required|string|max:255|unique:main_services,code,'.$this->route('main_service')->id.',id,deleted_at,NULL',
            'code' => 'required|string|max:255|unique:main_services,name,'.$this->route('main_service')->id.',id,deleted_at,NULL',
        ];
    }
}
