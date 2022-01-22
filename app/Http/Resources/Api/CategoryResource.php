<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;


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
//    dd(Route::currentRouteName());

    return  [
            "id" =>  $this->id,
            "name" =>  $request->lang == 'hi' ?  $this->hi_name: $this->name,
            "description" =>  $request->lang == 'hi' ? $this->hi_description : $this->description,
            'image' => is_null($this->image) ? '' :'storage/'.$this->image['url'],
            $this->mergeWhen($this->subCategory, [
                'subCategory' => $this->subCategory
            ]),
        ] ;
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
