<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            "name" =>  $request->lang == 'hi' ?  $this->hi_name: $this->name,
            "description" =>  $request->lang == 'hi' ? $this->hi_description : $this->description,
            'image' => !is_array($this->image) ? '' :$this->image['url'],
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
