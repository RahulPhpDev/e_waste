<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\PaginationEnum;
use App\Models\District;
use App\Enums\FlashMessagesEnum;



class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = District::paginate( PaginationEnum::Show10Records );
         return view('admin/district/index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/district/create');
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
        'name' => 'required|max:255',
        'code' => 'required|unique:districts|max:10',
        ]);

     District::create( $valid );
    return redirect()->route('admin.district.index')->with('success',FlashMessagesEnum::CreatedMsg);
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
    public function edit(District $district)
    {
        return view('admin/district/edit', [
            'record' => $district
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  District $district)
    {

         $valid =    $request->validate([
            'name' => 'required|max:255',
            'code' => [ 'required', 'max:10'    ]
        ]);

     $district->update( $valid );
    return redirect()->route('admin.district.index')->with('success',FlashMessagesEnum::UpdateMsg);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
         $district->delete();
        return redirect()->route('admin.district.index')->with('success',FlashMessagesEnum::DeletedMsg);;


    }
}
