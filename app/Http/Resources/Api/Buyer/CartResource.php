<?php

namespace App\Http\Resources\Api\Buyer;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
               "id" =>  $this->id,
                "user_id" =>  $this->user_id,
                $this->mergeWhen($this->cartProduct, [
                    'cartProduct' => $this->cartProduct
                ]),
            ];
    }

       /**
     * Add extra paramter
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'sucess' => true
        ];
    }
}
