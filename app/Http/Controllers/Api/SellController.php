<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ScrapSellingOrderResource;
use Illuminate\Http\Request;
use App\Http\Requests\Api\SellRequest;
use App\Models\Scrap;
use Illuminate\Support\Facades\DB;
use App\Models\UserAddress;
use Illuminate\Support\Arr;


class SellController extends Controller
{

    public function store(SellRequest $request)
    {
             DB::beginTransaction();
             try {
                     if ( !$request->user_address_id )
                     {
                        $userAddress = \Auth::user()->address()->create( $request->storeInAddress());
                     } else {
                         $userAddress = UserAddress::findOrFail($request->user_address_id);
                     }
                    $scrap = Scrap::create($request->storeInScrap() );
                    $scrap->user_address_id = $userAddress->id;
                    $scrap->save();
                    $scrap->schedule()->create( $request->storeInSchedule() );
                    // for($i=0; $i  < count($request->product['name']); $i++)
                    // {
                      $scrapProduct = $scrap->scrapproducts()
                        ->create($request->storeInScrapProduct()); 
                   
                    if ( $request->hasFile('image') &&
                        $request->file('image')->isValid()
                    )
                    {
                         $validated = $request->validate([
                                'image' => 'mimes:jpeg,png,svg|max:5014',
                            ]);
                       // dd($request->file('image')->extension());
                        $path =  $request
                                ->file('image')
                                ->storeAs('public/scrap/',
                                    $scrapProduct->id.'.'.
                                        $request->file('image')->extension()
                                );

                            $scrapProduct->image()->create([
                                'url' => $path,
                            ]);

                    }
                // }

                    DB::commit();
                return response()->json([
                    'success' => 'true'
                ]);
              // return new ScrapSellingOrderResource($scrap);
             } catch (\Exception $e) {
                 DB::rollBack();
                return response()->json([
                    'success' => 'false',
                    'msg' => $e->getMessage()
                ]);
             }

    }


}
