<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\OrderStatusEnum;
use Illuminate\Support\Str;
use Carbon\Carbon;
class Order extends Model
{
	 use SoftDeletes;
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

			$model->save();
		});
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
