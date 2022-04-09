<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Scrap;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;


class ScrapExport implements FromCollection, WithHeadings
{
    private $request ;

    public $excelColoum = [
           'id' => 'Id',
           'scrap_num' => 'Scrap Num',
            'user_name' => 'User',
            'phone'=> 'Phone',
            'zone_name'=> 'Collection Store',
            'created_at' => 'Create At',
            'status'=> 'Status',
            'schedule_date' => 'Scedule Date Time',
            'schedule_time' => 'Scedule Time',
            // 'Description',
            'userAddress.flat' => 'User Address',
            'order_user_name' => 'User Name Provide'

    ];

    public function __construct(Request $request) 
    {
        $this->request =  $request;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $status = [
            'all' => 3,
            'approved' => 1,
            'un-approved' => 2,
            'pending' => 0
        ];
              // dd('status', array_reverse(array_keys($status)));
       $statusVal = !is_null($this->request->get('status')) && 
                array_key_exists( $this->request->get('status') ,$status ) 
           ?  $status[$this->request->get('status')] 
           : null;

           //  // $uri = $request->getRequestUri();
           // if ($this->request->daterange)
           // {
           //       $dateArr = explode("-",$this->request->daterange);
           //       $startDate = $dateArr[0];
           //       $endDate = $dateArr[1];
           // }
       
        // dd($dateArr);

         $selectzone =  $this->request->get('zone');

            $scrap = new Scrap();
            $records =   $scrap->filterData(
                 $this->request, 
                 $statusVal, 
                 $selectzone 
             )->get();
              $statusRe = array_reverse(array_keys($status));

            $reference_mails = $records->map(function($item) use ($statusRe){
              
                $outputArray = [];
                $output = new \stdClass();
                $output->id = $item->id;
                $output->scrap_num = $item->scrap_num;
                $output->phone = $item->phone;
                $output->created_at = $item->created_at->toDateString();
                $output->status = $statusRe[$item->status];
                $output->order_user_name = $item->user_name;
                $output->zone_name = $item['zone']->name;
                $output->schedule_date = $item['schedule']->date;
                $output->schedule_time = $item['schedule']->time;
                $output->userAddress_flat = $item['userAddress']->flat;
                $output->user_name = $item['user']->name;
                return $output;
            });
return $reference_mails;
    }

    public function headings(): array
    {
        return [
              'id', 
                'scrap_num', 
                'phone', 
                'created_at', 
                'status', 
                'order_user_name', 
                'zone_name', 
                'schedule_date', 
                'schedule_time', 
                'userAddress_flat', 
                'user_name'
        ];
    }
}
