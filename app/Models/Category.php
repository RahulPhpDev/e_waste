<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TranslatorTrait;

class Category extends Model
{
	use SoftDeletes,TranslatorTrait ;

	 protected $guarded = [];

	 public $translatable = ['name', 'description'];


	public function image()
	{
		return $this->morphOne(Image::class, 'imageable');
	}

}
