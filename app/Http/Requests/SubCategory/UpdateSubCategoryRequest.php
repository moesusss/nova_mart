<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
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
            'code' => 'required|string|unique:sub_categories,code,'.$this->route('sub_category')->id.',id,deleted_at,NULL',
            'category_id' => 'required',
            'name' => 'required|string|unique:sub_categories,name,'.$this->route('sub_category')->id.',id,deleted_at,NULL',
        ];
    }
}
