<?php

namespace App\Http\Controllers\Api;

use App\Enums\PaginationEnums;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class ApiEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record = [];
        // Event::all();
       return response()->json([
        'data' => $record,
        'sucess' => true
    ]);
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
}
