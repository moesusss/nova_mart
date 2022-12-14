<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
{
    /**
     * Determine if the hub vendor is authorized to make this request.
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|max:255',
            'mm_name'  => 'nullable|string',
            'vendor_id' => 'required|uuid|exists:vendors,id',
            'category_id' => 'required|uuid|exists:categories,id',
            'sub_category_id' => 'required|uuid|exists:sub_categories,id',
            'brand_id' => 'nullable|uuid|exists:brands,id',
            // 'qty' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'is_active' => 'nullable|boolean',
            'is_tax'    => 'nullable|boolean',
            'is_instock' => 'nullable|boolean',
            'is_package' => 'nullable|boolean',
            'description' => 'required',
            'item_type' => 'nullable',
            'weight_convention_id' => 'required|uuid|exists:weight_conventions,id',
        ];
    }
}
