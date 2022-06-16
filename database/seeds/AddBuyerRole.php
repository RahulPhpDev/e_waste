<?php

use Illuminate\Database\Seeder;

class AddBuyerRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [['name' => 'Buyer']];

        App\Models\Role::insert( $roles);
    }
}
