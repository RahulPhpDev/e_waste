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

            // 'phone' => 'required',
            // 'otp' => 'required',
            // 'country_code' => 'required',

            // 'email' => 'required_with:password',
            // 'password' => 'required_with:email',

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
                $token = $user->createToken('authToken')->accessToken;
                // dd($token->token);
                $user->token = $token->token;
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
