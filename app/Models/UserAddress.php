<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TranslatorTrait;

class UserAddress extends Model
{
	use SoftDeletes, TranslatorTrait;

	 protected $guarded = [];

	public $translatable = ['flat', 'area', 'landmark'];

	 public function district()
	 {
	 	return $this->belongsTo(District::class);
	 }


    //
}
