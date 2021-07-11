<?php

namespace App\Traits;


use App\Scope\OrderByIdScope;


trait OrderByTrait
{


    protected  static function bootOrderByTrait()
    {
        static::addGlobalScope(new OrderByIdScope);
    }



}