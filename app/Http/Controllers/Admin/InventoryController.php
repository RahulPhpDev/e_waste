<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FlashMessagesEnum;
use App\Enums\PaginationEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Product,
    Inventory,
    Type
};
use DB;
use App\Http\Requests\Admin\InventoryRequest;
use Illuminate\Support\Facades\Storage;


class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
       $records = Product::with('inventory', 'inventory.image' , 'inventory.type', 'cartProduct')
                        ->findOrFail($product_id);
                        // dd($records, $records->cartProduct->sum('quantity') );
       return view('admin.inventory.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        $product = Product::findOrFail($product_id);
        $types = Type::pluck('name', 'id')->prepend('Select Type', '');
        return view('admin/inventory/create',compact('product', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {
           $inventory = $product -> inventory() -> create( $request->createProductInventoryDetails() );

            if ( $request->hasFile('product_image') &&
                $request->file('product_image')->isValid()
            )
            {
                 $validated = $request->validate([
                        'product_image' => 'mimes:jpeg,png|max:1014',
                    ]);

                $path =  $request->file('product_image')
                                    ->storeAs('public/product/'. $product->id.'/inventory',
                                        $inventory->id.'.'.$request->product_image->extension()
                                    );

                    $inventory->image()->create([
                        'url' => $path,
                    ]);

            }
         DB::commit();
        return redirect()->route('admin.product.inventories.index', $product->id)
                            ->with('success',FlashMessagesEnum::CreatedMsg);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.product.inventories.create', $product->id);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {

        $product = Product::findOrFail($inventory->product_id);
        $types = Type::pluck('name', 'id')->prepend('Select Type', '');
        return view('admin/inventory/edit',
        [
            'record' => $inventory,
            'product' => $product,
            'types' => $types
        ]);
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
        $inventory =Inventory::findOrFail($id);
        $inventory->update(
            $request->only('type_id','quantity', 'price')
        );
            return redirect()->route('admin.product.inventories.index', $inventory->product_id)
                            ->with('success',FlashMessagesEnum::UpdateMsg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $pId = $inventory->product_id;
       $inventory->delete();
       return redirect()->route('admin.product.inventories.index', $pId)
                            ->with('success',FlashMessagesEnum::DeletedMsg);

    }
}
