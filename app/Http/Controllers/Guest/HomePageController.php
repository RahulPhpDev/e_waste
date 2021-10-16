<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Resources\Api\ScrapSellingOrderResource;
// use Illuminate\Http\Request;
use App\Http\Requests\Api\SellRequest;
use App\Models\Scrap;
use Illuminate\Support\Facades\DB;
// use App\Models\UserAddress;
use Illuminate\Support\Arr;
use App\User;

class HomePageController extends Controller
{
    public function whyWe()
    {
        $page = Page::where('type', 'Why We')->first();
        return response()->json($page);
    }


  public function store(SellRequest $request)
    {
        $request->merge([
            'zone_id' => "1",
            'phone' => "11223232",
            'price' => "12",
            'landmark' => "Nanda tent",
            'date' => "2021-07-20",
            'time' => "17:15:19",
            'district_id' => "1",
            'zip_code' => "11111",
            'type' => "2",
            'user_name' => "Reuben ",
            'flat' => "23 india",
            'category_id' => "1",
            'quantity' => "2",
            'name' => "Mobile"
            // "zone_id" => "1"
        ]);
       // dd(User::find(2));
        // echo var_dump($request->phone);
        // $res =\App\Models\Zone::findOrFail($request->zone_id);
        //      dd($res,$request->zone_id );
             DB::beginTransaction();
             try {
                     if ( !$request->user_address_id )
                     {
                        $userAddress = User::find(2)->address()->create( $request->storeInAddress());
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
