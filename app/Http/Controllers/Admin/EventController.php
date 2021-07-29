<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Enums\PaginationEnum;
use App\Enums\FlashMessagesEnum;
use  App\Http\Requests\Admin\EventRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class EventController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = Event::paginate( PaginationEnum::Show10Records );
         return view('admin/event/index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/event/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
    $event = Event::create(  $request->createEvent() );
    if ( $request->hasFile('video') &&
            $request->file('video')->isValid()
        )
        {
            $Vpath =  $request->file('video')
                                ->storeAs('public/event/video',
                                    $event->id.'.'.$request->video->extension()
                                );

                $event->video = $Vpath;
                $event->save();

        }

     if ( $request->hasFile('banner') &&
            $request->file('banner')->isValid()
        )
        {
            $path =  $request->file('banner')
                                ->storeAs('public/event/banner',
                                    $event->id.'.'.$request->banner->extension()
                                );
          \Log::info($path);

                $event->image()->create([
                    'url' => $path,
                ]);

        }
    return redirect()->route('admin.event.index')->with('success',FlashMessagesEnum::CreatedMsg);
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
    public function edit(Event $event)
    {
        return view('admin/event/edit', [
            'record' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request,  Event $event)
    {

    $event->update(  $request->updateEvent() );
    return redirect()->route('admin.event.index')->with('success',FlashMessagesEnum::UpdateMsg);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Event $event)
    {
         $event->delete();
        return redirect()->route('admin.event.index')->with('success',FlashMessagesEnum::DeletedMsg);;


    }


    public function videoDelete($id)
    {
        $event = Event::findOrFail($id);


         // Storage::delete('public/'.$event->video);
         $event->video = null;
         $event->update();
        return redirect()->route('admin.event.index')->with('success',FlashMessagesEnum::DeletedMsg);;


    }



    public function imageDelete($id)
    {
        $event = Event::with('image')->findOrFail($id);

         Storage::delete('public/'.$event->image->url);
         $event->image()->delete();
        return redirect()->route('admin.event.index')->with('success',FlashMessagesEnum::DeletedMsg);;


    }

    public function imageUpdate (Request $request,$id)
    {
        $event = Event::with([ 'image' =>  function ($query) {
            $query->withTrashed('image');
        }])->findOrFail($id);


        if ( $request->hasFile('banner') &&
            $request->file('banner')->isValid()
        )
        {

            $path =  $request->file('banner')
                                ->storeAs('public/event/banner',
                                    $event->id.'.'.$request->banner->extension()
                                );
            if ( $event->image && $event->image->trashed()) {
              $event->image->restore();
            }
            $image =$event->image();

                if ( $event->image )
                {
                  $image->update([
                                'url' =>  Str::replaceFirst('public/', '', $path)
                            ]);
                } else {
                  $image->create([
                                'url' =>  Str::replaceFirst('public/', '', $path)
                            ]);
                }


          \Log::info(Str::replaceFirst('public/', '', $path));
        }

        return redirect()->route('admin.event.index')->with('success',FlashMessagesEnum::CreatedMsg);;

    }

     public function videoUpdate (Request $request,$id)
    {
        $event = Event::with('image')->findOrFail($id);
        if ( $request->hasFile('video') &&
            $request->file('video')->isValid()
        )
        {
            $Vpath =  $request->file('video')
                                ->storeAs('public/event/video',
                                    $event->id.'.'.$request->video->extension()
                                );

                $event->video = Str::replaceFirst('public/', '', $Vpath);
                $event->save();

        }


        return redirect()->route('admin.event.index')->with('success',FlashMessagesEnum::CreatedMsg);

    }
}
