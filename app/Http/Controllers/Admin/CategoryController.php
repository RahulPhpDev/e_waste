<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\PaginationEnum;
use App\Enums\FlashMessagesEnum;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = Category::with('image')->paginate( PaginationEnum::Show10Records );
         return view('admin/category/index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $valid =    $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:200',
        ]);

    $category =  Category::create( $valid );
       if ( $request->hasFile('category_image') &&
            $request->file('category_image')->isValid()
        )
        {
             $validated = $request->validate([
                    'category_image' => 'mimes:jpeg,png|max:1014',
                ]);

            $path =  $request->file('category_image')
                                ->storeAs('public/category',
                                    $category->id.'.'.$request->category_image->extension()
                                );

                $category->image()->create([
                    'url' => $path,
                ]);

        }
    return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
         return view('admin/category/edit', [
            'record' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
          $valid =    $request->validate([
            'name' => 'required|max:255',
             'description' => 'required|max:200',
        ]);

     $category->update( $valid );
    return redirect()->route('admin.category.index')->with('success',FlashMessagesEnum::CreatedMsg);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
       $category->delete();
       return redirect()->route('admin.category.index')->with('success',FlashMessagesEnum::DeletedMsg);;
    }
}
