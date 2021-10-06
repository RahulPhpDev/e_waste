<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TranslatorTrait;

class Video extends Model
{
	use SoftDeletes, TranslatorTrait;

	 protected $guarded = [];

     public $translatable = ['title'];


    //
}
