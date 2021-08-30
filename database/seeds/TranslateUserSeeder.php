<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\UserAddress;


class TranslateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       foreach( User::get() as $user ) {

            $user->translate();
            // if ( $user->address()->get() && count($user->address()->get()) > 0 )
            // {
            //     foreach ( $user->address()->get() as $address) {
            //         $address->translate();
            //     }
            // }

       }
    }
}
