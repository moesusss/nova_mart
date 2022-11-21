<?php

namespace App\Http\Requests\Artist;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtistRequest extends FormRequest
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
            'name' => 'required|string|unique:artists,name,' . $this->route('artist')->id,
            'mm_name' => 'required|string|unique:artists,mm_name,' . $this->route('artist')->id,
        ];
    }
}
