<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TranslatorTrait;


class SubCategory extends Model
{
	use SoftDeletes, TranslatorTrait;

	 protected $guarded = [];

     public $translatable = ['name', 'description'];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
