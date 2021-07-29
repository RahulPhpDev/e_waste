<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
//use Illuminate\Database\Eloquent\Model;

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

    }
}
