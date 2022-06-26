<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartProduct extends Model
{
	use SoftDeletes;

	 protected $guarded = [];

	protected static function boot()
	{
		parent::boot();
		self::deleted( function ($model) {
			$allCart = $model->where('cart_id', $model->cart_id)->first();	
			if (!$allCart )
			{
				$model->cart()->delete();
			}
		});
	}

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
