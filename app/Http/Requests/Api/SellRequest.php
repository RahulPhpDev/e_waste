<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
           'category_id.*' => 'required',
           'user_name' => 'required',
           'name.*' => 'required',
           'zone_id' => 'required',
           'phone' => 'required',
           'quantity.*' => 'required',
           'type' => 'required',
           'price.*' => 'required',
           'landmark' => 'required',
           'date' => 'required',
           'time' => 'required',
           'district_id',
           'flat',
           'area',
           'zip_code',
           'landmark',
           'user_address_id'
        ];
    }

    public function prepareForValidation()
    {

        $this->merge([
            'user_id' => $this->user()->id
        ]);
    }

    public function storeInScrap()
    {
        // return $this->only('user_id','name', 'user_name', 'phone', 'category_id', 'price', 'quantity', 'zone_id', 'type');
        return $this->only('user_id', 'user_name', 'phone',  'zone_id', 'type');
    }

    public function storeInScrapProduct($index)
    {

        $data =$this->only(
            'product.name.'.$index,
             'product.category_id.'.$index,
              'product.price.'.$index, 
              'product.quantity.'.$index,
      );
       
       $final= [];
      foreach( collect($data)->values()->values()->first() as $key => $value) {
        $final[$key] = $value && array_values($value) ? array_values($value)[0] : null;
      }
      return $final;
    }

    public function storeInSchedule()
    {
        return $this->only('time', 'date');
    }

    public function storeInAddress()
    {
        return $this->only('district_id',
           'flat',
           'zip_code',
           'landmark', 'area');
    }
}
