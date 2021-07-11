<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
	use SoftDeletes;

	 protected $guarded = [];

	 public function product()
	 {
	 	return $this->belongsTo(Product::class);
	 }

	 public function type ()
	 {
	 	return $this->belongsTo(Type::class);
	 }

	 public function image()
	 {
	 	return $this->morphOne(Image::class, 'imageable');
	 }
    //
}
