<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dump($this->image);

        return  [
            "id" =>  $this->id,
            "category_id" =>  $this->category_id,

            "name" =>  $request->lang == 'hi' ?  $this->hi_name: $this->name,
            "description" =>  $request->lang == 'hi' ? $this->hi_description : $this->description,
            'image' => is_null($this->image) ? '' :'storage/'.$this->image['url'],
            "category" =>  $this->when( $this->category , new CategoryResource( $this->category ) ),
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
