<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ScrapExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Scrap;
use App\Enums\PaginationEnum;
use Illuminate\Support\Str;
use Carbon\Carbon;


class ScrapReportController extends Controller
{
    public function index(Request $request) 
    {
       $searchParams =  Str::after($request->getRequestUri(), '/report?');
       // dd($after);
         $status = [
            'all' => 3,
            'approved' => 1,
            'un-approved' => 2,
            'pending' => 0
        ];

       $statusVal = !is_null($request->get('status')) && 
                array_key_exists( $request->get('status') ,$status ) 
           ?  $status[$request->get('status')] 
           : null;
         $selectzone =  $request->get('zone');

            $scrap = new Scrap();
            $records =   $scrap->filterData( $request, $statusVal, $selectzone );
            $records = $records ->paginate( PaginationEnum::Show10Records );


            $zones  = $scrap->get()->pluck( 'zone.name', 'zone.id');

       return view('admin/report/index' , compact('records', 'zones', 'selectzone', 'searchParams'), ['status' => $request->get('status')]);
    }

    public function export(Request $request)
    {   
        // $uri = $request->getRequestUri();
        // $dateArr = explode("-",$request->daterange);
        // dd($dateArr);
        $now = Carbon::now();
        $nowDate = $now->toDateString();
        $lastThree = Str::of(now()->timestamp)->substr(-3);
          return  Excel::download(new ScrapExport($request), "scrap_report_$nowDate.'_'.$lastThree.csv");
            // dd(  $records->get());
    }
}
