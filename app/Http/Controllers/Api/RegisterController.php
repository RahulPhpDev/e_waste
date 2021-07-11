<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\Api\RegisterResource;


class RegisterController extends Controller
{


    use RegistersUsers;

       /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {

    $validator = Validator::make($request->all(), [
             'phone_number' => ['required',  'regex:/[0-9]{10}/', 'digits:10', 'unique:users,phone'],
        ]);
       if ( $validator->fails() )
       {
        return $validator->validate();
       }

        $randomNumber = random_int(1000, 9999);

        $user =  User::create([
            'name' => 'Guest',
            'role_id' => 3,
            'active' => 1,
            'phone' => $request['phone_number'],
            'password' => Hash::make($randomNumber),
        ]);

        $token = $user->createToken($user->id);
        $user->otp = $randomNumber;
        $user->token = $token->plainTextToken;

        return new RegisterResource($user);

    }
}
