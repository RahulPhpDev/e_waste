<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Article extends Model
{
	use SoftDeletes;

	 protected $guarded = [];


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
