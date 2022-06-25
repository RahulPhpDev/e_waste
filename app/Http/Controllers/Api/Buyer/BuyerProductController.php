<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Models\{Product,Category, Cart, CartProduct};
use Illuminate\Http\Request;
// use Auth;

class BuyerProductController extends Controller
{
   public function index(Request $request) {

       $catgory = CategoryResource::collection(Category::with('image')->get());
       $product =  Product::isProductInCart()
                    ->with('image')
                    ->when($request->category_id, function ($model) use($request) {
                          return $model->where('category_id',  $request->category_id);
                         })
                    ->get();
       return collect([
           'product' => $product,
           'category' => $catgory,
           'sucess' => true
       ]);

   }
}
