<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [['name' => 'Super Admin'], ['name' => 'Center Admin'], ['name' => 'User']];

        App\Models\Role::insert( $roles);
    }
}
