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
        $images = '';
        foreach ($this->scrapproducts as $key => $value) {
            if ($value->image )
            {
                $images = !is_null($value->image) ?   'storage/'.$value->image->url : '';
            }
            
        }
       $scheduleCount = $this->schedule ?count($this->schedule->toArray()) : 1;


       $product = new ScrapProductCollection($this->scrapproducts);
       $prouctCollection  = $product->collection ? $product->collection[0] : [];
        return [
            'user_name' => $this->user_name,
            'user_phone' => $this->phone,
            'product_name' => $prouctCollection['name'],
            'product_description' => $prouctCollection['description'],
            'quantity' => $prouctCollection['quantity'],
            'schedule_date' => $this->when( $scheduleCount > 1, $this->schedule->date),
            'schedule_time' => $this->when( $scheduleCount > 1, $this->schedule->time),
            'product_image' => $images,
            'type' => $this->type === 1 ? 'Sell' : 'Donate' 
        ];

        // return [
        //     'user' => $this->name,
        //     'user_name' => $this->user_name,
        //     'phone' => $this->phone,
        //     'product' => new ScrapProductCollection($this->scrapproducts),
        //     // 'quantity' => $this->quantity,
        //     // 'price' => $this->price,
        //     // 'category' => new CategoryResource($this->category),
        //     'user_address' => $this->load('userAddress'),
        //     // 'schedule' => $this->when( $scheduleCount > 1, $this->schedule),
        //     'image' => $images,
        //     //'zone' =>$this->when($this->zone, new ZoneResource($this->zone))
        // ];
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
