<?php

use Illuminate\Database\Seeder;

class AddYoutubeVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $videos = [

            [
                'title' => 'SPECS Vigyaan Mela 2017',
                'url' => 'https://youtu.be/8i2mo4-knrs'
            ],
            [
                'title' => 'Shashpur Day 3(Training on LED repairing and manufacturing of LED lights)',
                'url' => 'https://youtu.be/RibM22rZJLk'
            ],
            [
                'title' => 'Shaspur Day 1-Training on LED lights',
                'url' => 'https://youtu.be/QVfyQMxVYlo'
            ],
            [
                'url' => 'https://youtu.be/evDuIL9M160',
                'title' => 'E waste Minimisation and Management workshop ,Vikas Nagar,DehraDun',
            ],
            [
                'url' => 'https://youtu.be/B77x4XdVlkk',
                'title' => 'Rap Song E Waste Management #ukboy',
            ],
            [
                'url' => 'https://youtu.be/iPWiC17VEi4',
                'title' => 'Short Film: The Future of Archaeology',
            ],
            [
                'url' => 'https://youtu.be/eKYd1EtD-rs',
                'title' => 'LED bulb can be rebuild',
            ],
            [
                'url' => 'https://youtu.be/YgyEVbK5Oe0',
                'title' => 'Training on Repairing and Manufacturing of LED bulb,Tube Light',
            ],
            [
                'url' => 'https://youtu.be/UicvTnqOnKI',
                'title' => 'Shashpur Day 4Training on LED Lights',
            ],
            [
                'url' => 'https://youtu.be/THmWus5E8tk',
                'title' => 'Coverage by NEWS 24',
            ],
            [
                'url' => 'https://youtu.be/ZeJVdf4wuZs',
                'title' => 'TEASER- E Waste',
            ],
            [
                'url' => 'https://youtu.be/fs7VSv1cdcQ',
                'title' => 'Shashpur Training Day 7',
            ],
            [
                'url' => 'https://youtu.be/YtBJVMZAHJ0',
                'title' => 'Jal Prehri- Water Guardian by SPECS, Dehradun',
            ],
            [
                'url' => 'https://youtu.be/Y6kIyhI9zeU',
                'title' => 'Ukhimat - An Energy Efficient District of Uttrakhand',
            ],
            [
                'url' => 'https://youtu.be/egfourPHS-M',
                'title' => 'Shashpur Day-2 Training on LED lights (manufacturing-Repairing)',
            ],
            [
                'url' => 'https://youtu.be/FyMusVoC2NE',
                'title' => 'Science Mela',
            ],
            [
                'url' => 'https://youtu.be/lO7eb0kzJJg',
                'title' => 'Lighting Up Lives',
            ],
            [
                'url' => 'https://youtu.be/leIvQtX-Kq4',
                'title' => 'Shashpur Training Day 6',
            ],
        ];
        $videoObj = new App\Models\Video();

        foreach ( $videos as $key => $video)
       {
        $videoObj->create( $video )->translate();
          sleep(0.5);
       }
        // $videoObj = new App\Models\Video();
        // $videoObj->create( $videos )->translate();
        // App\Models\Video::create( $videos)->translate();
    }
}
