<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Product,
    Unit,
    Category,
    Type
};
use App\Http\Requests\Admin\ProductRequest;
use App\Enums\PaginationEnum;
use App\Enums\FlashMessagesEnum;
use DB;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = Product::paginate( PaginationEnum::Show10Records );
         return view('admin/product/index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::pluck( 'name' , 'id')->prepend('Select Unit', '' );
        $categories = Category::pluck('name', 'id')->prepend('Select Category', '');
        $types = Type::pluck('name', 'id'   )->prepend('Select Type', '');
        return view('admin/product/create',compact('units', 'categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
       DB::beginTransaction();

        try {

        $product = Product::create( $request->createProductDetails() );

        if ( $request->hasFile('product_image') &&
            $request->file('product_image')->isValid()
        )
        {
             $validated = $request->validate([
                    'product_image' => 'mimes:jpeg,png|max:1014',
                ]);

            $path =  $request->file('product_image')
                                ->storeAs('/product',
                                    $product->id.'.'.$request->product_image->extension()
                                );

                $product->image()->create([
                    'url' => $path,
                ]);

        }
        $product->inventory()->create( $request->createProductInventoryDetails()  );
        DB::commit();
        return redirect()->route('admin.product.index')->with('success',FlashMessagesEnum::CreatedMsg);

            } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.product.create');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->loadMissing('inventory', 'category', 'unit');
        return view('admin.product.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->loadMissing('inventory', 'category', 'unit');
        $units = Unit::pluck( 'name' , 'id')->prepend('Select Unit', '' );
        $categories = Category::pluck('name', 'id')->prepend('Select Category', '');
         $types = Type::pluck('name', 'id'   )->prepend('Select Type', '');
        return view('admin/product/edit', [
            'record' => $product,
            'units' => $units,
            'types' => $types,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update( $request->updateProductDetails() );
        $product->inventory()->save( $request->updateProductInventoryDetails()  );
        return redirect()->route('admin.product.index')->with('success',FlashMessagesEnum::CreatedMsg);
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
