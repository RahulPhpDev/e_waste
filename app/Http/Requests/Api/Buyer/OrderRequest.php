<?php

namespace App\Http\Requests\Api\Buyer;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'product_id' => 'required', 'exists:App\Models\Product,id',
            'quantity' => 'required', 'digits',
            'phone'=> ['required', 'digits_between:10,12'],
            'pin_code' => ['required', 'digits:6'],
            'address'=> 'required',
        ];
    }
}
