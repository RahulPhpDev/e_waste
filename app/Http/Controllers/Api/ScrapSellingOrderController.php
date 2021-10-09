<?php

namespace App\Http\Controllers\Api;

use App\Enums\PaginationEnums;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ScrapSellingOrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Scrap;

class ScrapSellingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scrap = Auth::user()->scrapOrder()->get();

        // $images = [];
        // foreach ($this->scrapproducts as $key => $value) {
        //     if ($value->image )
        //     {
        //         $images[$value->image->id] = !is_null($value->image) ?   'storage/'.$value->image->url : '';
        //     }
            
        // }
        return  ScrapSellingOrderResource::collection($scrap);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
