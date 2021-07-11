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

});

