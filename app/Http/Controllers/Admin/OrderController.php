<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Enums\PaginationEnum;

class OrderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $records = Order::with('user','orderAddress', 'product:id,name', 'product.image:id,url')->paginate( 10 );

           return view('admin/order/index' , compact('records'));
        // return response(['sucees' => true, 'data' => $order], 200);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->dispatch_date = $request->dispatch_date;
        $order->orderAddress()->update(
            [
                'admin_comment' => $request->reason
            ]
        );
        $order->save();
    return redirect()->route('admin.order.index')->with('success','Order updated');;

    }
}
