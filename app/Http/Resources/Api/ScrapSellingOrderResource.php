<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ScrapSellingOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $scheduleCount = $this->schedule ?count($this->schedule->toArray()) : 1;
        return [
            'user' => $this->name,
            'user_name' => $this->user_name,
            'phone' => $this->phone,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'category' => new CategoryResource($this->category),
            'user_address' => new UserAddressResource($this->user_address),
            'schedule' => $this->when( $scheduleCount > 1, $this->schedule),
            'image' =>  $this->when( $this->image, 'storage/'.$this->image->url),
            'zone' =>$this->when($this->zone, new ZoneResource($this->zone))
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
