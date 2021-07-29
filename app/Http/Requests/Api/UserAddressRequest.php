<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
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
           'district_id' => 'required',
           'area' => 'required',
           'flat',
           'zip_code' => 'required',
           'landmark',
            // => 'required',
           'lattitude',
           'longitute'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id,
        ]);
    }

    public function storeInAddress()
    {
        return $this->only(
            'user_id',
            'district_id',
           'area',
           'flat',
           'zip_code',
           'landmark',
           'lattitude',
           'longitute'
       );
    }
}
