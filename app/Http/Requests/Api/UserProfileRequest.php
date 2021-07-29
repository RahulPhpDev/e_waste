<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'name' => 'required',
            'email',
            'zip_code',
            'landmark',
            'district_id',
            'lattitude',
            'longitute'
        ];
    }

   public function prepareForValidation()
    {
        $this->merge([
            'active' => 1,
        ]);
    }

    public function storeInAddress()
    {
        return $this->only(
            'user_id',
            'district_id',
           'area',
           'flat',
           'active',
           'zip_code',
           'landmark',
           'lattitude',
           'longitute'
       );
    }
}
