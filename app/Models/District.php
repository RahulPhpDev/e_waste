<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use App\Traits\TranslatorTrait;

class District extends Model
{
	use TranslatorTrait;


    protected $guarded = [];


    public $translatable = ['name'];
    //
}
