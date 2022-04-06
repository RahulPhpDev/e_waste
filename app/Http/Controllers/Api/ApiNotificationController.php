<?php

namespace App\Http\Controllers\Api;

use App\Enums\PaginationEnums;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = \Auth::user();
       return  response()->json(['sucess' => true,'data' =>$user->unreadNotifications]);

       // $user->unreadNotifications;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $user = \Auth::user();
        if ( $request->id ) {
          $notication =      $user->unreadNotifications->find($request->id);
        } else {

          $notication =  $user->unreadNotifications;
        }
         $notication->markAsRead();
        return response()->json(['sucess' => true]);
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

     public function read()
    {
        $user = \Auth::user();
        $user->unreadNotifications->markAsRead();
        return response()->json(['data' => 'success']);
    }

}
