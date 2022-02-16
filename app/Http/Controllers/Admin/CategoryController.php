<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\PaginationEnum;
use App\Enums\FlashMessagesEnum;
use App\Models\Category;
use Illuminate\Support\Arr;

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

    $category =  Category::create( $valid )->translate();
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
        tap($category)->update( $valid )->translate();
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


    public function bilingual(Category $category, string $field)
    {
        return view('admin.category.bilingual',[
            'record' => $category,
             'field' => 'hi_'.$field,
             'field_value'  =>  $category->{'hi_'.$field}
        ]);
    }


    public function editImage(Category $category)
    {
        return view('admin.category.edit-image', ['record' => $category ]);

    }

    function updateImage(Request $request, Category $category)
    {

        if ( $request->hasFile('image') &&
                $request->file('image')->isValid()
            )
            {
                 $validated = $request->validate([
                        'image' => 'mimes:jpeg,png,jpg,svg|max:5014',
                    ]);

                $path =  $request->file('image')
                                    ->storeAs('public/category/',
                                        $category->id.'.'.$request->image->extension()
                                    );
                if ( is_null($category->image  ) )
                {
                 $category->image()->create([
                        'url' => $path,
                    ]);
             }
         } else {
            return redirect()->route('admin.category.index')->with('error','Not able to upload');
         }

        return redirect()->route('admin.category.index')->with('success',FlashMessagesEnum::UpdateMsg);
    }



    public function storeBilingual(Request $request, Category $category)
    {
      $final= collect($category->translatable)->filter( function($value) use ( $request) {
            return Arr::exists($request->all()  ,  'hi_'.$value );
        })->map( function ($rec)  {
            return 'hi_'.$rec;
        })->all();
        $category->update($request->only($final));
        return redirect()->route('admin.category.index')->with('success',FlashMessagesEnum::UpdateMsg);
    }
}
