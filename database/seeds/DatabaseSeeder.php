<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             RoleSeeder::class,
             AdminSeeder::class, 
             CategorySeeder::class,
             DistrictSeeder::class,
             TranslateCategorySeeder::class,
            TranslateUserSeeder::class,
            AddYoutubeVideoSeeder::class,
            ]);
    }
}
