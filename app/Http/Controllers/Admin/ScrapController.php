<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FlashMessagesEnum;
use App\Enums\PaginationEnum;
use App\Http\Controllers\Controller;
use App\Models\Scrap;
use Illuminate\Http\Request;

class ScrapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = [
            'all' => 3,
            'approved' => 1,
            'un-approved' => 2,
            'pending' => 0
        ];

       $statusVal = !is_null($request->get('status')) && 
                array_key_exists( $request->get('status') ,$status ) 
           ?  $status[$request->get('status')] 
           : null;
           $records = Scrap::query()
                ->with('user','scrapproducts')
                ->when(
                       isset($statusVal), function ($query) use ($statusVal) { 
                        return $query->where('status', $statusVal);
                        }
                )
                ->paginate( PaginationEnum::Show10Records );

 
       return view('admin/scrap/index' , compact('records'), ['status' => $request->get('status')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
       $record = Scrap::find($id);
        return view('admin/scrap/detail', compact('record') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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


    public function approval(Request $request,$id)
    {
       Scrap::find($id)->update(
           [
               'status' => $request->get('status')
           ]
           );
           return redirect()->route('admin.scrap.index');
    }
}
