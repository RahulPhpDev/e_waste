<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{

	 protected $guarded = [];

	 public $timestamps = false;

	 public function order() {
	 	return $this->belongsTo(Order::class);
	 }
    //
}
