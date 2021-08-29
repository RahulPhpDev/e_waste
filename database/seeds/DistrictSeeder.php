<?php

use Illuminate\Database\Seeder;
use  App\Models\District;
use  App\Models\Zone;


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
       ];
       foreach ( $seeder as $key => $seed)
       {
         $data = $district->create( $seed )->translate();
       }
       $this->zoneSeeder();

    }



    public function zoneSeeder()
    {
       $dId =  District::whereName('Haridwar')->first()->id;
        $seeder = [
            [

                'name' => 'M/s Attero Recycling Pvt. ltd. Kh. No.117, Raipur Industrial Area, Bhagwanpur 12000 19971',
                'district_id' => $dId ,
                'zip_code' => 247661
            ],
            [

                'name' => 'M/s Bharat Oil & Waste Management ltd. Mauja, Mukimpur, Laksar, Haridwar',
                'district_id' => $dId ,
                'zip_code' => 247663
            ],
            [

                'name' => 'M/s Resource E-Waste Solution Pvt.Ltd. F-97, Industrial area, Bhadrabad, Haridwar',
                'district_id' => $dId ,
                'zip_code' => 249402
            ],
            [

                'name' => 'M/s Anmol Paryavaran Sanrakshan Samiti, Daulatpur,Hazaratpur urf, Budhwasahid, Daulatpur',
                'district_id' => $dId ,
                'zip_code' => 249402
            ],
            [

                'name' => 'Scarto Metal Recycle plant , Kh. No-314 Kh, village -Mehvar Khurd, Roorkee',
                'district_id' => $dId ,
                'zip_code' => 247667
            ],
        ];

        $zone = new Zone();
        foreach ( $seeder as $key => $seed)
       {
         $data = $zone->create( $seed )->translate();

       }

   }


}
