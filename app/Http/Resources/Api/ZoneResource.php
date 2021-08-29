<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ZoneResource extends JsonResource
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
            "district_id" => $this->district_id,
            "name" => $this->name,
            "zip_code" => $this->zip_code,
            "lattitude" => $this->lattitude,
            "longitute" => $this->longitute,
            "image" => '',
            "landmark" => $this->landmark,
            "district" => [
               "id" => $this->district->id,
                "name" => $this->district->name,
                "code" => $this->district->code,
            ]
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
