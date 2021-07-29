<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Page;


class HomePageController extends Controller
{
    public function whyWe()
    {
        $page = Page::where('type', 'Why We')->first();
        return response()->json($page);
    }
}
