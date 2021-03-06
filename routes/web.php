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

Route::get('/privacy', function () {
    return view('guest.privacy');
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
   Route::get('district/bilingual/{district?}/{field?}', 'DistrictController@bilingual')->name('district.bilingual');
   Route::put('district/bilingual/{district?}', 'DistrictController@storeBilingual')
            ->name('district.bilingual');

//
   Route::resource('type', 'ProductTypeController');
   Route::resource('category', 'CategoryController');
      Route::get('category/bilingual/{category?}/{field?}', 'CategoryController@bilingual')->name('category.bilingual');
   Route::put('category/bilingual/{category?}', 'CategoryController@storeBilingual')
            ->name('category.bilingual');

   Route::get('category/edit-image/{category}', 'CategoryController@editImage')->name('category.image-edit');      
   Route::put('category/edit-image/{category?}', 'CategoryController@updateImage')->name('category.update-image');   


//===== Sub category ==
    Route::resource('sub-category', 'SubCategoryController');

      Route::get('sub-category/bilingual/{subcategory?}/{field?}', 'SubCategoryController@bilingual')->name('sub-category.bilingual');


   Route::put('sub-category/bilingual/{subcategory?}', 'SubCategoryController@storeBilingual')
            ->name('sub-category.bilingual');

   Route::get('sub-category/edit-image/{id}', 'SubCategoryController@editImage')->name('sub-category.image-edit');   

   Route::put('sub-category/edit-image/{subcategory?}', 'SubCategoryController@updateImage')->name('sub-category.update-image');   



   Route::resource('zone', 'ZoneController');
   Route::resource('product', 'ProductController');

//shallow nesting routing

   Route::resource('product.inventories', 'InventoryController')->shallow();
   Route::resource('why-we', 'WhyWeController');
   Route::resource('article', 'ArticleController');
   Route::delete('article/video/{id}/destroy', 'ArticleController@videoDelete')->name('article.destroy.video');
   Route::delete('article/image/{id}/destroy', 'ArticleController@imageDelete')->name('article.destroy.image');

  Route::get('article/bilingual/{article?}/{field?}', 'ArticleController@bilingual')->name('article.bilingual');
   Route::put('article/bilingual/{article?}', 'ArticleController@storeBilingual')
            ->name('article.bilingual');



   Route::any('article/image/{id}/store', 'ArticleController@imageUpdate')->name('article.image.store');
   Route::any('article/video/{id}/store', 'ArticleController@videoUpdate')->name('article.video.store');


   Route::resource('event', 'EventController');
   Route::delete('event/video/{id}/destroy', 'EventController@videoDelete')->name('event.destroy.video');
   Route::delete('event/image/{id}/destroy', 'EventController@imageDelete')->name('event.destroy.image');

   Route::any('event/image/{id}/store', 'EventController@imageUpdate')->name('event.image.store');
   Route::any('event/video/{id}/store', 'EventController@videoUpdate')->name('event.video.store');

   Route::resource('video', 'VideoController');
   Route::get('video/bilingual/{video?}/{field?}', 'VideoController@bilingual')->name('video.bilingual');
   Route::put('video/bilingual/{video?}', 'VideoController@storeBilingual')
            ->name('video.bilingual');

    Route::patch('scrap/{id}/approval', 'ScrapController@approval')->name('scrap.approval');      
      Route::resource('scrap', 'ScrapController'); 
      
      Route::get('/report', 'ScrapReportController@index');
      Route::post('/report', 'ScrapReportController@export')->name('report.scrap');
      Route::get('/order', 'OrderController@index')->name('order.index');
      Route::put('/order/{id?}', 'OrderController@update')->name('order.update');
      Route::get('/order/{order?}', 'OrderController@show')->name('order.detail');

});

    Route::resource('admin/notification', 'NotificationController')->middleware('auth');
    Route::post('admin/notification/read', 'NotificationController@read')->middleware('auth');



