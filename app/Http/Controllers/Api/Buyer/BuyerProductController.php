<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BuyerProductController extends Controller
{
   public function index() {

       $catgory = CategoryResource::collection(Category::with('image')->get());

       return collect([
           'category' => $catgory,
         'product' =>  Product::get(),
         'sucess' => true
       ]);
       

   }
}
