<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'code' => 'required|string|unique:categories,code,'.$this->route('category')->id.',id,deleted_at,NULL',
            'main_service_id' => 'required',
            'name' => 'required|string|unique:categories,name,'.$this->route('category')->id.',id,deleted_at,NULL',
        ];
    }
}
