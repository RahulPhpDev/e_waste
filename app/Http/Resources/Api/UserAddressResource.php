<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
             "id" => $this->id,
            "user_id" => $this->user_id,
             'district_id' => $this->district_id,
            // "district" => new DistrictResource( $this->loadMissing('district')),
            "flat" => $this->flat,
            "area" => $this->area,
            "zip_code" => $this->zip_code,
            "lattitude" => $this->lattitude,
            "longitute" => $this->longitute,
            "landmark" => $this->landmark,
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
