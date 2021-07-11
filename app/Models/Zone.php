<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
	use SoftDeletes;

	 protected $guarded = [];

	 public $with = ['district'];


	 public function district()
	 {
	 	return $this->belongsTo( District::class );
	 }

    //
}
