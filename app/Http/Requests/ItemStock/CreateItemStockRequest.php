<?php

namespace App\Http\Requests\ItemStock;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemStockRequest extends FormRequest
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
            // 'code' => 'required|unique:sub_categories,code,NULL,id,deleted_at,NULL',
            'item_id' => 'required|uuid|exists:items,id',
            'vendor_id' => 'required|uuid|exists:vendors,id',
            'qty' => 'required|digits_between:1,3'
        ];
    }
}
