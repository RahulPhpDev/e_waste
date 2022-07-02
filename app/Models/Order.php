<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\OrderStatusEnum;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Traits\OrderByTrait;
use App\User;

class Order extends Model
{
	 use SoftDeletes, OrderByTrait;
	 protected $appends = ['order_status'];
	 protected $casts = [
	 	'created_at' => 'datetime:Y-m-d'
	 ];
	 protected $dates = ['dispatch_date'];

	 public $with = ['orderAddress'];
	 protected $guarded = [];

	public $statusEnum = [
		0 => 'pending',
		1 => 'accept',
		'dispatched'=> 'Dispatched',
		'delivered' => 'delivered',
		'rejected' => 'Rejected',
	];

	public $statusEnumKeys = [
		0 => 'pending',
		1 => 'accept',
		2=> 'Dispatched',
		3 => 'delivered',
		4 => 'Rejected',
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
	 	return $this->statusEnumKeys[$this->status];
	 }

	 public function product()
	 {
	 	return $this->belongsTo(Product::class);
	 }

	 public function user() {
	 	return $this->belongsTo(User::class);
	 }

	 public function getCreatedAtAttribute($value) 
	 {
	 		// $this->attributes['schedule_at'] =
	 		return Carbon::parse($value)->format('d-M-Y');;
	 	// return Carbon::d>format('Y-m-d');;
	 }
    //
}
