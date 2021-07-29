<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $imageUrl = !is_null($this->image) ? $this->image->url: false;
        return [
            "id" => $this->id,
            "name" => $this->name,
            "role_id" => $this->role_id,
            "email" => $this->email,
            "phone" => $this->phone,
            "active" => $this->active,
            "address" =>  $this->when( $this->address , new UserAddressResource( $this->address ) ),
            'image' =>  $this->when($imageUrl, 'storage/'.$imageUrl),
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
