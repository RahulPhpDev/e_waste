<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\Api\UserAddressResource;
use App\Http\Requests\Api\UserAddressRequest;
use App\Models\UserAddress;

class ApiUserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Auth::user()->address()->get();
        return  UserAddressResource::collection($address);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddressRequest $request)
    {
      $address = UserAddress::create( $request->storeInAddress() );
      return new UserAddressResource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserAddressRequest $request, int $id)
    {

      $address = tap(UserAddress::whereId($id))->update( $request->storeInAddress()) ->first()  ;
      return new UserAddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAddress $userAddress)
    {
        $userAddress->delete();
        return response()->json([
                'msg' => 'Deleted Successfully',
                'sucess' => true
            ]);
    }
}
