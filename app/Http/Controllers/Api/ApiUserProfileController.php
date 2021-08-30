<?php

namespace App\Http\Controllers\Api;

use App\Enums\PaginationEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserProfileRequest;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\UserAddress;
use App\Http\Resources\Api\UserProfileResource;

class ApiUserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = User::with('address')->findOrFail(Auth::id() );
       return response()->json(new UserProfileResource($user->loadMissing( 'image') ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserProfileRequest $request)
    {
        $user=   User::with(['address' => function ($query) {
            $query->where('active', 1)->latest();
        }])->findOrFail(Auth::id() );
        $user->update( $request->storeInProfile() );

         $user->translate();
        if ( $user->address === null )
        {

            $address = $user->address()->save( new UserAddress($request->storeInAddress() ) )->translate();
        } else {
            $address =  $user->address->update( $request->storeInAddress() );
            $user->address->translate();
        }



            if ( $request->hasFile('image') &&
                $request->file('image')->isValid()
            )
            {
                 $validated = $request->validate([
                        'image' => 'mimes:jpeg,png,jpg|max:5014',
                    ]);

                $path =  $request->file('image')
                                    ->storeAs('public/user/',
                                        $user->id.'.'.$request->image->extension()
                                    );
                if ( is_null($user->image  ) )
                {
                 $user->image()->create([
                        'url' => $path,
                    ]);
             }  else {
                $user->image()->update([
                        'url' => $path,
                    ]);
             }


            }
        return response()->json(new UserProfileResource($user->load( 'image', 'address') ) );
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
}
