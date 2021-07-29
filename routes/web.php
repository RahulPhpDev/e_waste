<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect('/login');
});


Auth::routes(
    [
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]
);




// use this instead of name method
Route::group([
    'as' => 'admin.',// name argument
    'prefix' => 'admin',//append this in url
    'namespace' => 'Admin',
    'middleware' => 'admin'
], function () {
   Route::resource('user', 'UserController');
   Route::get('dashboard',function() {
   	return view('admin/dashboard');
   });
   Route::resource('district', 'DistrictController');
   Route::resource('type', 'ProductTypeController');
   Route::resource('category', 'CategoryController');
   Route::resource('zone', 'ZoneController');
   Route::resource('product', 'ProductController');

//shallow nesting routing

   Route::resource('product.inventories', 'InventoryController')->shallow();
   Route::resource('why-we', 'WhyWeController');
   Route::resource('article', 'ArticleController');
   Route::delete('article/video/{id}/destroy', 'ArticleController@videoDelete')->name('article.destroy.video');
   Route::delete('article/image/{id}/destroy', 'ArticleController@imageDelete')->name('article.destroy.image');

   Route::any('article/image/{id}/store', 'ArticleController@imageUpdate')->name('article.image.store');
   Route::any('article/video/{id}/store', 'ArticleController@videoUpdate')->name('article.video.store');


   Route::resource('event', 'EventController');
   Route::delete('event/video/{id}/destroy', 'EventController@videoDelete')->name('event.destroy.video');
   Route::delete('event/image/{id}/destroy', 'EventController@imageDelete')->name('event.destroy.image');

   Route::any('event/image/{id}/store', 'EventController@imageUpdate')->name('event.image.store');
   Route::any('event/video/{id}/store', 'EventController@videoUpdate')->name('event.video.store');

});

