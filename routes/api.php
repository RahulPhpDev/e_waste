<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
// 'middleware' => 'auth:api',
'namespace' => 'Guest'
], function () {
       Route::get('why-we','HomePageController@whyWe' );
       Route::get('store','HomePageController@store' );
       Route::get('page/privacy', function () {
            return response()->json(
                [
                    'sucess' => true,
                    'data' => \App\Models\Page::whereType('privacy')->select('description as html')->first()
                ]
            );
       } );
});

Route::group([
    'namespace' => 'Api',
    'middleware' => 'auth:sanctum',
    // 'middleware' => 'apiToken',
    'as' => 'api.'
    // api prefix is already in place

], function () {
    Route::post('login', 'LoginApiController@login')->withoutMiddleware('auth:sanctum');;
    Route::post('register', 'RegisterController@create')->withoutMiddleware('auth:sanctum');
    Route::get('category','ApiCategoryController@index' );
    Route::get('category/{id?}/sub-category','ApiCategoryController@subcateogry' );
    

    Route::get('sub-category','ApiSubCategoryController@index' );
    Route::get('district','ApiDistrictController@index' );
    Route::get('district/{id}','ApiDistrictController@detail');
    Route::get('zone','ApiZoneController@index' );
    Route::get('inventory','ApiInventoryController@index' );
    Route::get('type','ApiProductTypeController@index' );
    Route::post('sell-scrap', 'SellController@store');
    Route::apiResource('user-address', 'ApiUserAddressController');
    Route::apiResource('scrap-order', 'ScrapSellingOrderController');
    Route::apiResource('profile', 'ApiUserProfileController');
    Route::get('video','ApiVideoController@index' );
    Route::apiResource('event', 'ApiEventController')->only('index', 'show');
    Route::apiResource('notification', 'ApiNotificationController');

    // buyer-api
    Route::group([
    'middleware' => 'buyer',
    // 'namespace' => 'buyer'
    ], function () {
        Route::get('buyer/category','ApiCategoryController@index' )->name('buyer.category');
        Route::get('buyer/product','Buyer/BuyerProductController@index' )->name('buyer.category');
     
        Route::get('buyer/product','Buyer\BuyerProductController@index' )->name('buyer.category');
        Route::apiResource('buyer/cart','Buyer\CartController');
        Route::apiResource('buyer/order','Buyer\OrderController');
});

   

    });

   