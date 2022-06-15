<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TranslatorTrait;

class UserAddress extends Model
{
	use SoftDeletes, TranslatorTrait;

	 protected $guarded = [];

	public $translatable = ['flat', 'area', 'landmark'];

	public $with = ['district'];
	// protected $casts = [
	//     'district_id' => 'integer',
	//     'zip_code'=> 'integer'
	// ];

	 public function district()
	 {
	 	return $this->belongsTo(District::class);
	 }

	public function setDistrictIdAttribute($value)
    {
        $this->attributes['district_id'] = (int) $value;
    }


	public function setZipCodeAttribute($value)
    {
        $this->attributes['zip_code'] = (int) $value;
    }


    //
}
