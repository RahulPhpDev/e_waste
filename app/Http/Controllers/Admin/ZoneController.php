<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\District;
use App\Enums\PaginationEnum;
use App\Enums\FlashMessagesEnum;
use App\Http\Requests\Admin\ZoneRequest;


class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Zone::paginate( PaginationEnum::Show10Records );
        return view ('admin.zone.index', compact('records') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $districts = District::pluck( 'name', 'id' );
       return view('admin.zone.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request)
    {
       Zone::create( $request->only('name','zip_code', 'lattitude', 'longitute', 'landmark', 'district_id', 'address', 'description', 'phone_number') );
       return redirect()->route('admin.zone.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        $districts = District::pluck( 'name', 'id' );
        return view('admin/zone/edit', [
            'record' => $zone,
            'districts' => $districts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ZoneRequest $request, Zone $zone)
    {
      $zone->update(
            $request->only('name','zip_code', 'lattitude', 'longitute', 'landmark', 'district_id', 'address', 'description', 'phone_number')
        );
        return redirect()->route('admin.zone.index')->with('success',FlashMessagesEnum::CreatedMsg);;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('admin.zone.index')->with('success',FlashMessagesEnum::DeletedMsg);;

    }
}
