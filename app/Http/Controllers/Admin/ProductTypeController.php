<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\PaginationEnum;
use App\Models\Type;
use App\Enums\FlashMessagesEnum;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = Type::paginate( PaginationEnum::Show10Records );
         return view('admin/type/index' , compact('records'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin/type/create');
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
        'description' => 'required|max:200',
        ]);

     Type::create( $valid );
    return redirect()->route('admin.type.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  Type $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin/type/edit', [
            'record' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
         $valid =    $request->validate([
            'name' => 'required|max:255',
             'description' => 'required|max:200',
        ]);

     $type->update( $valid );
    return redirect()->route('admin.type.index')->with('success',FlashMessagesEnum::CreatedMsg);;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
      $type->delete();
      return redirect()->route('admin.type.index')->with('success',FlashMessagesEnum::DeletedMsg);;


    }
}
