<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Image extends Model
{
	use SoftDeletes;

	// const CREATED_AT = 'created_at';

	const UPDATED_AT = null;

	protected $guarded = [];

	// public $timestamps = false;

	public function setUrlAttribute($value)
	{
		 $this->attributes['url'] =  Str::replaceFirst('public/', '', $value);
	}

	public function imageable()
	{
		return $this->morphTo();
	}


    //
}
