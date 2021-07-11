<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Http\Resources\Api\ZoneResource;

class ApiZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ZoneResource::collection( Zone::all() )
                ->additional([
                        'sucess' => true
                    ]);
    }


}
