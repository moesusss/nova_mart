<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubCategoryRequest extends FormRequest
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
            'code' => 'required|unique:sub_categories,code,NULL,id,deleted_at,NULL',
            'category_id' => 'required',
            'name' => 'required|unique:sub_categories,name,NULL,id,deleted_at,NULL'
        ];
    }
}
