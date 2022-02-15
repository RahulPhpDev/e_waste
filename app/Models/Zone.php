<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TranslatorTrait;
use App\User;

class Zone extends Model
{
	use SoftDeletes,TranslatorTrait ;

	 protected $guarded = [];

	 public $with = ['district'];

	  public $translatable = ['name', 'landmark', 'description', 'address'];


	 public function district()
	 {
	 	return $this->belongsTo( District::class );
	 }


	 public function user() {
		return $this->belongsToMany(User::class);
	 }

//
}
