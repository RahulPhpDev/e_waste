<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor/pagination/bootstrap-4');
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
        Relation::morphMap([
            'product' => 'App\Models\Product',
            'inventory' => 'App\Models\Inventory',
        ]);

        Collection::macro('translatable', function ( $model) {
            return $this->filter( function ($request, $key) use ($model) {
                return in_array( str_replace('hi_', '', $key), $model->translatable  );
            })->all();
        });

//        Builder::macro('createOrUpdateWithPrimaryKey', function ($attributes, $values) {
//
//            if (! is_null($instance = $this->where($attributes)->first())) {
//                return $instance;
//            }
//           $mode = get_class($this);
//            dd( (new  $mode)  );
////            dd(get_class($this)->getModel());
//            $res = get_class($this)->model->newInstance($attributes)->setConnection(
//                $this->query->getConnection()->getName()
//            );
//
//            return tap($this->$res( $values), function ($instance) {
//                dd($instance);
//                $instance->save();
//            });
//        });

        Validator::extend('ogg_extension', function($attribute, $value, $parameters, $validator) {
             
            if(!empty($value->getClientOriginalExtension()) && ($value->getClientOriginalExtension() == 'ogg')){
                return true;
            }else{
                return false;
            }
             
        });

   
        

    }

}
