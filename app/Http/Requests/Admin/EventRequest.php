<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class EventRequest extends FormRequest
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
            'description' => 'required|min:2'

        ];
    }

     public function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title, '-'),
            'created_by' => $this->user()->id
        ]);
    }

     /**
     *
    */

    public function createEvent()
    {
        return $this->only('title', 'description', 'slug', 'created_by', 'schedule_at');
    }

     /**
     *
    */

    public function updateEvent()
    {
        return $this->only('title', 'description');
    }
}
