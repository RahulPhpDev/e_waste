<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Product extends Model
{
	use SoftDeletes;

	protected static function boot()
	{
		parent::boot();
		self::updating( function ($model) {
			if ($model->isDirty('price') ) {
				$model->cartProduct()->update(['price' => $model->price]);
			}
		});
	}

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
		return (string)$this->inventory()->where('approved', 1)->sum('quantity');
	}

	public function getApprovedInventory()
	{
		return $this->inventory()->where('approved', 1)->first();
	}

	public function cartProduct()
	{
		return $this->hasMany(CartProduct::class);
	}

	public function scopeIsProductInCart($query) {
		  $query->addSelect([
                'in_cart' =>  CartProduct::select('id')
                ->whereHas('cart' , function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                })
                ->whereColumn('product_id', 'products.id')->take(1)
           ]);
	}
    //
}
