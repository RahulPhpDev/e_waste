<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ScrapExport;
use Maatwebsite\Excel\Facades\Excel;




class ScrapReportController extends Controller
{
    public function index() 
    {
       return  Excel::download(new ScrapExport, 'user.xlsx');
         dd('test');
    }
}
