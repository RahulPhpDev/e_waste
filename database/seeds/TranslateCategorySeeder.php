<?php

use Illuminate\Database\Seeder;
use App\Models\Category;


class TranslateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($category = Category::get() as $value)
        {
            $value->translate();
        }

    }
}
