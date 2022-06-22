<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Enums\PaginationEnums;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order,Product,OrderAddress};
use App\Http\Requests\Api\Buyer\OrderRequest;
use Illuminate\Support\Facades\DB;
use Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Auth::user()->order;
        $order->loadMissing('orderAddress', 'product:id,name');

        return response(['sucees' => true, 'data' => $order], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($request->product_id);
            $price = $product->price;
               $order =  Order::create([
                    'product_id' => $product->id,
                    'price' => $price,
                    'quantity' =>$request->input('quantity', 1),
                    'user_id' => Auth::user()->id
                ]);

            
              $order->orderAddress()->create([
                  'email' => $request->input('email', null),
                  'phone' => $request->input('phone', null),
                  'alternative_phone' => $request->input('alternative_phone', null),
                  'pin_code' => $request->input('pin_code', null),
                  'address' => $request->input('address', null),
                  'landmark' => $request->input('landmark', null),
                  'district' => $request->input('district', null),
                  'state' => $request->input('state', null),
                  'comment' => $request->input('comment', null),
               ]);
              
               DB::commit();
                return response()->json([
                    'success' => 'true'
                ]);
           } catch (\Exception $e) {
             DB::rollBack();
            return response()->json([
                'success' => 'false',
                'msg' => $e->getMessage()
            ]);
         }

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
        //
    }
}
