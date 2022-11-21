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
            // 'username'  => 'required|string|unique:users,username',
            'email'     => 'required|email|unique:users,email',
            'phone'             => 'nullable|numeric|unique:users,phone',
            'address'  => 'nullable|string',
            'password' => 'required|string|confirmed|min:6',
            'roles' => 'required'
        ];
    }
}
