<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Api\CategoryResource;
// use App\Models\Sub

class ApiCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return CategoryResource::collection(Category::with('image')->get())
         ->additional([
                    'sucess' => true
                ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subcateogry( $id )
    {
        return new CategoryResource(Category::with(['subCategory','subCategory.image', 'image'])->findOrfail($id));
    }


}
