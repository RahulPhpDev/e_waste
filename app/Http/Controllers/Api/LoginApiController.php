<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;


class LoginApiController extends Controller
{
     use AuthenticatesUsers;


        public function login (Request $request) {

            $validator = Validator::make($request->all(), [
                    'phone' => 'required_with_all:otp',
                    'otp' => 'required_with_all:phone',
            ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $matchForPassword = $request->password ?? $request->otp;
        if ( $request->email){
          $user = User::where('email', $request->email)->first();
        } else {
        	$user = User::where('phone', $request->phone)->first();
        }
        
        if ($user) {

            if (Hash::check($matchForPassword, $user->password)) {
                // $token = $user->createToken('authToken')->accessToken;
                // @todo maybe not required
                if ($request->user &&   strtolower($request->user) === 'buyer') {
                   $buyerRole =  $user->role_id === \App\Models\Role::whereName('Buyer')->first()->id;
                   dd($buyerRole,  $user);
                   if (!$buyerRole)  {
                          $response = ["message" => "Not a buyer user", 'success'=> false];
                           return response($response, 422); 
                   }
                }
              $token = $user->createToken($user->id)->plainTextToken;
                // dd($token->token);
                // $user->token = $token->token;
                $user->token = $token;
                $response = [
                              'success' => true,
                              'msg' => 'Otp Verified',
                              'data' => $user
                          ];
                return response($response, 200);
            } else {
                $response = ["message" => "Otp mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'Otp does not exist'];
            return response($response, 422);
        }
    }


}
