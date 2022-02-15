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
      $name =   $this->command->ask('Give us your full Name');
      $email =   $this->command->ask('Give us your email');
      $password =   $this->command->ask('Give us your password');

      

       App\User::create(
        [
            'name' =>  $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role_id' => App\Models\Role::whereName('Super Admin')->first()->id,
            'active' => 1,
        ]
       );
       $this->command->info("Your email is $email and password is $password");
    }
}
