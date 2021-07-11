<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
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
            'otp' => $this->otp,
            'phone' => $this->phone,
            'token' => $this->token,
            'id' => $this->id

        ];
    }


       /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
           'success' => true,
            // 'msg' =>  ResponseMessages::CARTRESPONSE,
        ];
    }
}
