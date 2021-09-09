<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Resources\Api\DistrictResource;
use App\Models\Zone;
use App\Http\Resources\Api\ZoneResource;

class ApiDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return DistrictResource::collection( District::all() )
            ->additional([
                    'sucess' => true
                ]);
    }
    
    public function detail($id)
    {
     return  ZoneResource::collection(  Zone::where('district_id',$id)->get() )
                ->additional([
                        'sucess' => true
                    ]);
         
    }
}
