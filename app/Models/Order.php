<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\OrderStatusEnum;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Traits\OrderByTrait;
class Order extends Model
{
	 use SoftDeletes, OrderByTrait;
	 protected $appends = ['order_status'];

	 protected $guarded = [];

	protected $statusEnum = [
		0 => 'pending',
		1 => 'accept',
		2 => 'dispatched',
		3 => 'delivered',
		4 => 'rejected',
	];
	const PENDING =   0;
    const ACCEPT =   1;
    const DISPATCHED = 2;
    const DELIVERED = 3;
    const REJECTED = 4;

protected static function boot()
	{
		parent::boot();
		self::created( function ($model) {
			$model->order_num = 'EWMUO-'.Str::of(now()->timestamp)->substr(-3).$model->id;
			$model->deleteIfProductHasInCart();
			$model->decreaseProductQuantityByOrderProductQuantity(); // decrease the quanity of buy product
			$model->save();
		});
	}

	public function decreaseProductQuantityByOrderProductQuantity()
	{
		$product = $this->product;
		$activeInventory = $product->getApprovedInventory();
		$activeInventory->quantity = $activeInventory->quantity - $this->quantity;
		$activeInventory->save();
	}

	public function deleteIfProductHasInCart(){
		 $cart = 	$this->hasProductInCart();
		 if ($cart && $cart->exists() )
		 {
		 	$cartProduct =  $cart->cartProduct->first();
		 	$cartProduct->delete();
		 	$cartProduct->save();
		 	return true;
		 }
		 return false;
	}

	public function hasProductInCart()
	{
		return Cart::whereHas('cartProduct', function($query) {
					return $query->where('product_id', '=',$this->product_id);
				})->with('cartProduct')->where('user_id', $this->user_id)->first();
		
	}


	 public function orderAddress() {
	 	return $this->hasOne(OrderAddress::class);
	 }

	 public function getOrderStatusAttribute() 
	 {
	 	return $this->statusEnum[$this->status];
	 }

	 public function product()
	 {
	 	return $this->belongsTo(Product::class);
	 }
    //
}
