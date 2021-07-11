<?php

use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $cateories =

       [
                [
                    'name' => 'Large household appliances',
                    'description' => 'refrigerators/freezers, washing machines, dishwashers'
                ],

                [
                    'name' => 'Small household appliances',
                    'description' => 'toasters, coffee makers, irons, hairdryers'

                ],

                [
                    'name' => 'Information technology (IT)',
                    'description' => 'and telecommunications equipment (personal computers, telephones, mobile phones, laptops, printers, scanners, photocopiers)'

                ],

                [
                    'name' => 'Consumer equipment',
                    'description' => '(televisions, stereo equipment, electric toothbrushes)'

                ],

                [
                    'name' => 'Lighting equipment',
                    'description' => 'fluorescent lamps'

                ],

                [
                    'name' => 'Electrical and electronic tools',
                    'description' => 'handheld drills, saws, screwdrivers'

                ],

                [
                    'name' => 'Toys, leisure and sports equipment',
                    'description' => 'Toys, leisure and sports equipment'

                ],

                [
                    'name' => 'Medical equipment systems',
                    'description' => 'with the exception of all implanted and infected products'
                ],

                [
                    'name' => 'Monitoring and control instruments',
                    'description' => 'Monitoring and control instruments'

                ],
                [
                    'name' => 'Automatic dispensers',
                    'description' => 'Automatic dispensers'
                ]
            ];
            Category::insert($cateories);
    }
}
