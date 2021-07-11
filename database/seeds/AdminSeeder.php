<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       App\User::create(
        [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make(123456),
            'role_id' => App\Models\Role::whereName('Super Admin')->first()->id,
            'active' => 1,

        ]
       );
    }
}
