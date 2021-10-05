<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Api\SubCategoryResource;
use App\Models\SubCategory;

class ApiSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return SubCategoryResource::collection(SubCategory::with('image','category')->get())
         ->additional([
                    'sucess' => true
                ]);
    }
}
