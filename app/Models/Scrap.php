<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Illuminate\Support\Str;

class Scrap extends Model
{
	use SoftDeletes;

	 protected $guarded = [];


	//  protected $casts = [
	//     'user_id' => 'integer',
	//     'category_id'=> 'integer',
	//     'zone_id'=> 'integer',
	//     'user_address_id'=> 'integer',
	//     'approved_by'=> 'integer',
	//     'phone'=> 'integer',
	//     'status'=> 'integer',
	//     'type'=> 'integer'
	// ];

	 protected $with = ['userAddress', 'category','schedule','zone'];

	protected static function boot()
	{
		parent::boot();
		self::created( function ($model) {
			$model->scrap_num = 'EWMU-'.Str::of(now()->timestamp)->substr(-3).$model->id;

			$model->save();
		});
	}
	 public function user()
	 {
	 	return $this->belongsTo(User::class, 'user_id');
	 }


	 public function scrapOwner()
	 {
	 	return $this->belongsTo(User::class, 'user_id');
	 }

	 public function approvedBy()
	 {
	 	return $this->belongsTo(User::class, 'approved_by');
	 }

	 public function category()
	 {
	 	return $this->belongsTo(Category::class)->withDefault();
	 }

	 public function userAddress()
	 {
	 	return $this->belongsTo(UserAddress::class)->withDefault();
	 }


	 public function zone()
	 {
	 	return $this->belongsTo(Zone::class)->withDefault([]);
	 }

	 public function schedule()
	 {
	 	return $this->hasOne(Schedule::class)->withDefault();
	 }

	  public function scrapproducts()
	 {
	 	return $this->hasMany(ScrapProduct::class);
	 }

	 public function getScrapStatusAttribute() {
		// dd($this);
		 switch($this->status) {
			case 0:
				return 'Pending';
			case 1:
				return 'Approved';
			case 2:
				return 'Discard';
			default:
			return 'not donf';	
		}
	 }

	 // public function products()
	 // {
	 // 	return $this->belongsToMany(Product::class, 'scrap_product')->withPivot('name', 'quantity', 'price');
	 // }


    //
}
