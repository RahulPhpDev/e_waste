<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
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
            // 'unit_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'description' => '',
            'price' => 'numeric',
            // 'type_id' => 'required',
            'quantity' => 'numeric'

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
            'uuid' => Str::slug($this->name, '-'),
            'approved' =>  $this->user()->role_id  === 1 ? 1 : 0,
            'created_by' => $this->user()->id
        ]);

    }

    /**
     *
    */

    public function createProductDetails()
    {
        return $this->only('uuid','price' , 'category_id', 'name', 'description', 'active','created_by');
    }

     /**
     *
    */

    public function createProductInventoryDetails()
    {
        return $this->only('type_id',  'approved', 'quantity', 'created_by');
    }


   /**
     *
    */

    public function updateProductDetails()
    {
        return $this->only('price' ,'category_id', 'name', 'description');
    }

    /**
     *
    */

    public function updateProductInventoryDetails()
    {
        return $this->only('type_id','category_id',  'quantity');
    }


}
