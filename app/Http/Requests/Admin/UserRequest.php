<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;


class UserRequest extends FormRequest
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
        // 'unique:users,email_address,'.$user->id
        return [
        'email' => ['required','unique:users,email'],
            'role_id' => 'required', 'exists:App\Models\Role,id',
            'name' => 'required',
            'phone' => 'required',
            'zone_id' => 'required_if:role_id,2'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'active' =>  $this->user()->role_id  === 1 ? 1 : 0,
            'password' => rescue(function () {
                        return  Hash::make($this->password);
                    },  Hash::make(123456))
        ]);

    }


    /**
     *
     *
     *
    */

    public function fillUserDetails()
    {
        return $this->only('name', 'email', 'phone', 'role_id', 'password', 'active');
    }

      /**
     *
     *
     *
    */

    public function updateUserDetails()
    {
        return $this->only('name', 'email', 'phone', 'role_id', 'active');
    }
}
