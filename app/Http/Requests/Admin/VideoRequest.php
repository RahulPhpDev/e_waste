<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'banner' => 'mimes:jpeg,png,jpg|max:5014',
            'video' => 'mimes:mp4,mov|max:100014',
      ];
    }

     /**
     *
    */

    public function createVideo()
    {
        return $this->only('title', 'created_by');
    }

     /**
     *
    */

    public function updateVideo()
    {
        return $this->only('title');
    }
}
