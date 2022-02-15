<?php

use Illuminate\Database\Seeder;
use  App\Models\District;
use App\Models\Role;
use  App\Models\Zone;
use App\User;
use Illuminate\Support\Facades\Hash;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $district = new District();
       $seeder = [
           ['name' => 'Haridwar', 'code' => 247661 ],
           ['name' => 'Dehradun', 'code' => 248001 ],
       ];
       foreach ( $seeder as $key => $seed)
       {
          $district->create( $seed )->translate();
          sleep(0.5);
       }
       $this->zoneSeeder();

    }



    public function zoneSeeder()
    {
       $district =  District::query()->pluck( 'id','name');
        $seeder = [
            [
                'zone' => [
                    'name' => 'E-Waste Minimization Center Haripur Kalan',
                    'district_id' => $district['Dehradun'] ,
                    'zip_code' => 249411,
                    'lattitude'  => 30.0035,
                    'longitute' => 78.192,
                ],
                'user' => [
                    'name' => 'Mrs. Tulsi Mehra',
                    'phone' => '8171154692'
                ]
            ],
            [
              'zone' => [ 
                    'name' => 'E-Waste Minimization Center Bhogpur',
                    'district_id' =>  $district['Dehradun'] ,
                    'zip_code' => 248143,
                    'lattitude'  => 30.2081,
                    'longitute' => 78.2328,
                ],
                'user' => [
                    'name' => 'Mrs. Guddi devi',
                    'phone' => '8979287348'
                ]
            ],
            [
                'zone' => [
                    'name' => 'E-Waste Minimization Centre, Majri Grant',
                    'district_id' =>  $district['Dehradun'] ,
                    'zip_code' => 248001
                ],
                'user' => [
                    'name' => 'Mrs. Sudha Rani',
                    'phone' => '8909412273'
                ]
            ],
            [
                'zone' => [
                    'name' => 'E-Waste Minimization Center Kandoli',
                    'district_id' =>  $district['Dehradun'] ,
                    'zip_code' => 248007,
                    'lattitude'  => 30.3743,
                    'longitute' => 77.9615,
                ],  
                'user' => [
                    'name' => 'Mr. Ashok Kumar',
                    'phone' => '7706897611'
                ]
            ],
            [
                'zone' => [
                    'name' => 'E-Waste Minimization Center Atak Farm',
                    'district_id' =>  $district['Dehradun'] ,
                    'zip_code' => 248001
                ],
                'user' => [
                    'name' => 'Mrs. Sudha Devi',
                    'phone' => '8941923819'
                ]
            ],
            [
                'zone' => [
                    'name' => 'E-Waste Minimization Center Dharmawala',
                    'district_id' =>  $district['Dehradun'] ,
                    'zip_code' => 248001
                ],
                'user' => [
                    'name' => 'Mrs. Punita Sharma',
                    'phone' => '6396006081'
                ]
            ],
            [
                'zone' => [
                    'name' => 'E-Waste Minimization Center Mehunwala Khalsa',
                    'district_id' =>  $district['Dehradun'] ,
                    'zip_code' => 248198,
                    'lattitude'  => 30.4791,
                    'longitute' => 77.8007,
                ],
                'user' => [
                    'name' => 'Mrs. Anita patel',
                    'phone' => '8755002315'
                ]
            ],
            [
                'zone' => [
                    'name' => '115, Krishna Nagar, Dehradun',
                    'district_id' =>  $district['Dehradun'] ,
                    'zip_code' => 248001
                ],
                'user' => [
                    'name' => 'SPECS office',
                    'phone' => '9027629296'
                ]
            ],
        ];

        $zone = new Zone();
        $user = new User();
       $roleId =  Role::where('name', 'Center Admin')->first()->id;
        foreach ( $seeder as $key => $seed)
        {
                $zoneRecord = $zone->create( $seed['zone'] ) ->translate();
                sleep(0.5);

                $userRecord  =  $user->create( array_merge(
                        $seed['user'],
                        [
                            'active' => 1,
                            'role_id' => $roleId,
                             'password' =>  Hash::make('123456'), 
                        ] 
                        ) 
                    )
                    ->translate() ;
  $zoneRecord->user()->sync($userRecord);

            }

    }


}
