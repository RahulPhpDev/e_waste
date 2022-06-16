<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
            'quantity' => 'required',
            'quantity' => 'required',
            'type_id' => 'required'
        ];
    }

    public function prepareForValidation()
    {
           $this->merge([
            // 'product_id' => 11,
            'approved' =>  $this->user()->role_id  === 1 ? 1 : 0,
            'created_by' => $this->user()->id
        ]);
    }

     /**
     *
    */

    public function createProductInventoryDetails()
    {
        return $this->only('type_id', 'approved', 'quantity', 'created_by');
    }

}
