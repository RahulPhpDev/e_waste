<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FlashMessagesEnum;
use App\Enums\PaginationEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = Video::paginate( PaginationEnum::Show10Records );
         return view('admin/video/index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/video/create');
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
            'title' => 'required|max:255',
            'url' => 'required|max:200',
        ]);

     Video::create( $valid );
     // ->translate();
    return redirect()->route('admin.video.index');
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
    public function edit(Video $video)
    {
         return view('admin/video/edit', [
            'record' => $video
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Video $video)
    {
      $valid =    $request->validate([
         'title' => 'required|max:255',
         'url' => 'required|max:200',
        ]);

     $video->update( $valid );
     // ->translate();
    return redirect()->route('admin.video.index')->with('success',FlashMessagesEnum::CreatedMsg);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
       $video->delete();
       return redirect()->route('admin.video.index')->with('success',FlashMessagesEnum::DeletedMsg);;
    }


    public function bilingual(Video $video, string $field)
    {
        return view('admin.video.bilingual',[
            'record' => $category,
             'field' => 'hi_'.$field,
             'field_value'  =>  $category->{'hi_'.$field}
        ]);
    }



    public function storeBilingual(Request $request, Video $video)
    {
      $final= collect($video->translatable)->filter( function($value) use ( $request) {
            return Arr::exists($request->all()  ,  'hi_'.$value );
        })->map( function ($rec)  {
            return 'hi_'.$rec;
        })->all();
        $video->update($request->only($final));
        return redirect()->route('admin.video.index')->with('success',FlashMessagesEnum::UpdateMsg);
    }
}
