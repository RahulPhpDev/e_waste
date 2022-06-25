<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Enums\PaginationEnums;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order,Product,OrderAddress};
use App\Http\Requests\Api\Buyer\OrderRequest;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Notifications\OrderNotification;
use App\Exceptions\OutOfStockException;

class OrderController extends Controller
{
    // use OrderByIdScope;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Auth::user()->order;
        $order->loadMissing('orderAddress', 'product:id,name', 'product.image:id,url');
// dd($order);
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
            $adminUser =  User::where('role_id', 1)->first();
            $userId =  Auth::user()->id;
            $address = [
                  'email' => $request->input('email', null),
                  'phone' => $request->input('phone', null),
                  'alternative_phone' => $request->input('alternative_phone', null),
                  'pin_code' => $request->input('pin_code', null),
                  'address' => $request->input('address', null),
                  'landmark' => $request->input('landmark', null),
                  'district' => $request->input('district', null),
                  'state' => 2,
                  'comment' => $request->input('comment', null),
               ];
            $order_count =0; 
            foreach ($request->product as $key => $item) {
                $product = Product::findOrFail($item['id']);
                $quantity = $item['quantity'] ? $item['quantity'] : 1;
                if ( $product->product_quantity < $quantity)
                {
                    throw new OutOfStockException('Something Went Wrong.');
                }
                       $price = $product->price;
                       $order =  Order::create([
                            'product_id' => $product->id,
                            'price' => $price,
                            'quantity' => $quantity,
                            'user_id' => $userId,
                            'status' => 1
                        ]);
                
                  $order->orderAddress()->create($address);
                  ++$order_count;
            }


               \Notification::send($adminUser,new OrderNotification([
                    'user' => Auth::user()->name,
                    'order_count' => $order_count,
                    'link' => '/order'
               ]) );
            
               DB::commit();
                return response()->json([
                    'success' => 'true'
                ]);
           }
           catch (OutOfStockException $e) {
             DB::rollBack();
            return response()->json([
                'success' => 'false',
                'type' => 'out_of_stock',
                'msg' => 'Quantity is more than stock'
            ]);
         }
           
            catch (\Exception $e) {
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
