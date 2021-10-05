<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FlashMessagesEnum;
use App\Enums\PaginationEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;


class SubCategoryController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = SubCategory::with('image', 'category')->paginate( PaginationEnum::Show10Records );
         // dd($records);
         return view('admin/sub-category/index' , compact('records') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('name', 'id')->prepend('select option…', '');
        return view('admin/sub-category/create', compact('category'));
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
            'category_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required|max:200',
        ]);

    $subCategory =  SubCategory::create( $valid )->translate();
       if ( $request->hasFile('category_image') &&
            $request->file('category_image')->isValid()
        )
        {
             $validated = $request->validate([
                    'category_image' => 'mimes:jpeg,png|max:1014',
                ]);

            $path =  $request->file('category_image')
                                ->storeAs('public/sub-category',
                                    $subCategory->id.'.'.$request->category_image->extension()
                                );

                $subCategory->image()->create([
                    'url' => $path,
                ]);

        }
    return redirect()->route('admin.sub-category.index');
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
    public function edit(SubCategory $subCategory)
    {
         $category = Category::pluck('name', 'id')->prepend('select option…', '');
         return view('admin/sub-category/edit', [
            'record' => $subCategory,
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,SubCategory $subCategory)
    {
          $valid =    $request->validate([
            'category_id' => 'required',
            'name' => 'required|max:255',
             'description' => 'required|max:200',
        ]);

     $subCategory->update( $valid );
     $subCategory->translate();
    return redirect()->route('admin.sub-category.index')->with('success',FlashMessagesEnum::CreatedMsg);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $subCategory =  SubCategory::findOrFail($id);
       $subCategory->delete();
       return redirect()->route('admin.sub-category.index')->with('success',FlashMessagesEnum::DeletedMsg);;
    }


    public function bilingual(SubCategory $subCategory, string $field)
    {
        return view('admin.sub-category.bilingual',[
            'record' => $subCategory,
             'field' => 'hi_'.$field,
             'field_value'  =>  $subCategory->{'hi_'.$field}
        ]);
    }


    public function editImage( $id)
    {
      $subCategory =  SubCategory::findOrFail($id);
        return view('admin.sub-category.edit-image', ['record' => $subCategory ]);

    }

    function updateImage(Request $request, $id)
    {
        $subCategory =  SubCategory::findOrFail($id);

        if ( $request->hasFile('image') &&
                $request->file('image')->isValid()
            )
            {
                 $validated = $request->validate([
                        'image' => 'mimes:jpeg,png,jpg,svg|max:5014',
                    ]);

                $path =  $request->file('image')
                                    ->storeAs('public/sub-category/',
                                        $subCategory->id.'.'.$request->image->extension()
                                    );
                                    // dd($subCategory->image);
                if ( !is_null($subCategory->image  ) )
                {
                 $subCategory->image()->create([
                        'url' => $path,
                    ]);
             }
         } else {
            return redirect()->route('admin.sub-category.index')->with('error','Not able to upload');
         }

        return redirect()->route('admin.sub-category.index')->with('success',FlashMessagesEnum::UpdateMsg);
    }



    public function storeBilingual(Request $request, SubCategory $subCategory)
    {
      $final= collect($subCategory->translatable)->filter( function($value) use ( $request) {
            return Arr::exists($request->all()  ,  'hi_'.$value );
        })->map( function ($rec)  {
            return 'hi_'.$rec;
        })->all();
        $subCategory->update($request->only($final));
        return redirect()->route('admin.sub-category.index')->with('success',FlashMessagesEnum::UpdateMsg);
    }
}
