<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Enums\PaginationEnums;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use App\Http\Requests\Api\Buyer\CartRequest;
use Auth;
use App\Http\Resources\Api\Buyer\CartResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Auth::user()->cart();
       $record =  $cart
                    ->with('cartProduct','cartProduct.product.image:id,url' ,'cartProduct.product:id,name')
                    ->get();
        return CartResource::collection($record);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        // check if cart exist 
        // insert into product
        $product = Product::findOrFail($request->product_id);
        $userId = Auth::user()->id;
        $cart = Cart::updateOrCreate(
            ['user_id' => $userId],
            ['user_id' => $userId]
        );

       $cartProduct = CartProduct::updateOrCreate(
            [
                'cart_id' =>  $cart->id,
                'product_id' => $request->product_id,
            ],
            [
                'cart_id' =>  $cart->id,
                'product_id' => $request->product_id,
                'price'=> $product->price,
                // 'quantity' => $request->input('quantity', 1),
            ]
        );
       if ($cartProduct->wasRecentlyCreated && $cartProduct->wasChanged()) {
          $cartProduct->quantity = $cartProduct->quantity + $request->input('quantity', 1);
       } else {
         $cartProduct->quantity =$request->input('quantity', 1);
       }
      $cartProduct->save();
      return response([
        'success' => true,
        'msg' => 'Add to cart'
      ], 200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartProduct::destroy($id);
        return response( [ 'success' => true,
        'msg' => 'Remove from cart'], 200);
    }
}
