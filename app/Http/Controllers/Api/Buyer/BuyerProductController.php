<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BuyerProductController extends Controller
{
   public function index() {
       $catgory = Category::pluck( 'name', 'id');

       return collect([
           'category' => $catgory,
         'product' =>  Product::get(),
         'sucess' => true
       ]);
       

   }
}
