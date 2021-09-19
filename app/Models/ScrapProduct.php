<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TranslatorTrait;

class ScrapProduct extends Model
{
	use SoftDeletes,TranslatorTrait;

	public $table = 'scrap_product';

	 protected $guarded = [];

 	 public $translatable = ['name', 'description'];

 	 public $timestamps = FALSE;


	 public function image()
	 {
	 	return $this->morphOne(Image::class, 'imageable');
	 }
	 
    //
}
