<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartProduct extends Model
{
	use SoftDeletes;

	 protected $guarded = [];

	 public function product()
	 {
	 	return $this->belongsTo(Product::class);
	 }

	 public function cart()
	 {
	 	return $this->belongsTo(Cart::class);
	 }

    //
}
