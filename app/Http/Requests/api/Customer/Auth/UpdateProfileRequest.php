<?php

namespace App\Http\Requests\api\Customer\Auth;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'               => 'required|string|max:255',
            'email'              => 'nullable|email|unique:customers,email,'.auth()->user()->id,
            'mobile'              => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|phone:MM|unique:customers,mobile,'.auth()->user()->id,
            
            // 'address'            => 'nullable|string',
            // 'old_password'       => 'required_with:new_password|string|min:6',
            // 'new_password'       => 'nullable|confirmed|string|min:6',
        ];
    }

    /**
    * Configure the validator instance.
    *
    * @param  \Illuminate\Validation\Validator  $validator
    * @return void
    */
    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         if ($this->has('old_password') && !Hash::check($this->old_password, \Auth::user()->password)) {
    //             $validator->errors()->add('old_password', 'Old password not valid');
    //         }
    //     });
    // }

    public function updateProfile($user) : Customer
    {
        $user->name = $this->name ? $this->name : $user->name;
        $user->email = $this->email ? $this->email : $user->email;
        $user->mobile = $this->mobile ? $this->mobile : $user->mobile;
        // $user->address = $this->address ? $this->address : $user->address;
        // $user->password = $this->new_password ? bcrypt($this->new_password) : $user->password;

        if($user->isDirty()) {
            $user->save();
        }

        return $user->refresh();
    }
}
