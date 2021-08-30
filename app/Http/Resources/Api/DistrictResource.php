<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            "name" => $request->lang == 'hi' ?   $this->hi_name : $this->name,
            "description" =>  $request->lang == 'hi' ?  $this->hi_description : $this->description,
        ];
    }

       /**
     * Add extra paramter
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function additional($request)
    {
        return [
            'sucess' => true
        ];
    }
}
