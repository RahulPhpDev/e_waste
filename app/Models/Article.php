<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\TranslatorTrait;

class Article extends Model
{
	use SoftDeletes, TranslatorTrait;

	 protected $guarded = [];

	 public $translatable = ['title', 'description'];


	public function image()
	{
		return $this->morphOne(Image::class, 'imageable');
	}

	public function setUrlAttribute($value)
	{
		 $this->attributes['video'] =  Str::replaceFirst('public/', '', $value);
	}
    //
}
