<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'mobile'     => 'nullable|unique:users,mobile|regex:/^([0-9\s\-\+\(\)]*)$/|phone:MM',
            'password' => 'required|string|same:password_confirmation|min:6',
            'roles' => 'required'
        ];
    }
}
