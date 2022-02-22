<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
	use SoftDeletes;
	//Casts of the model dates
// 	protected $casts = [
// 		'schedule_at'  => 'datetime:Y-m-d\TH:i'
//   ];
	
	 protected $guarded = [];


	public function image()
	{
		return $this->morphOne(Image::class, 'imageable');
	}

	public function setScheduleAtAttribute($value) 
	{
		
		$this->attributes['schedule_at'] = $value->format('Y-m-d');;
	}

    //
}
