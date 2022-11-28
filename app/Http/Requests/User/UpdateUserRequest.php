<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->route('user')->id,
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|phone:MM|unique:users,mobile,'.$this->route('user')->id,
            'password' => 'same:password_confirmation',
            'roles' => 'required'
        ];
    }
}
