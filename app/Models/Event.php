<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
	use SoftDeletes;

	 protected $guarded = [];


	public function image()
	{
		return $this->morphOne(Image::class, 'imageable');
	}
    //
}
