<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Product extends Model
{
	use SoftDeletes;

	 protected $guarded = [];

	 protected $appends = ['product_quantity'];

	public function unit()
	{
	 	return $this->belongsTo(Unit::class);
	}


	public function category()
	{
		return $this->belongsTo(Category::class);
	}


	public function inventory()
	{
		return $this->hasMany(Inventory::class);
	}

	public function image()
	{
		return $this->morphOne(Image::class, 'imageable');
	}

	public function getProductQuantityAttribute()
	{
		return $this->inventory()->where('approved', 1)->sum('quantity');
	}

	public function cartProduct()
	{
		return $this->hasMany(CartProduct::class);
	}

	// public function isProductInCart() {
	// 	if (!Auth::user()) return false;
	// 	dd($this);
	// }
    //
}
