<?php

namespace App\Http\Controllers;

use App\Models\invices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $invices = invices::sum('Total');

        $count = invices::count();

        $invices_unpaid = invices::where('Value_Status', 2)->sum('Total');
        $invices_unpaid2 = invices::where('Value_Status', 1)->sum('Total');
        $invices_unpaid3 = invices::where('Value_Status', 3)->sum('Total');

        $invices_count2 = invices::where('Value_Status', 2)->count();

        $invices_count1 = invices::where('Value_Status', 1)->count();
        $invices_count3 = invices::where('Value_Status', 3)->count();

        $invices_unpaidPrec = $invices_count2 /$count *100;
        $invices_unpaidPrec1 = $invices_count1 /$count *100;
        $invices_unpaidPrec2 = $invices_count3 /$count *100;

        return view('home',
        ['invices'=>$invices ,'count'=>$count ,'invices_unpaid' =>$invices_unpaid ,
        'invices_unpaidPrec' =>$invices_unpaidPrec ,'invices_count2' =>$invices_count2,'invices_count1'=>$invices_count1 ,
        'invices_unpaidPrec1' =>$invices_unpaidPrec1,'invices_unpaid2'=>$invices_unpaid2 ,'invices_count3' =>$invices_count3,
        'invices_unpaid3' =>$invices_unpaid3 ,'invices_unpaidPrec2' =>$invices_unpaidPrec2]);
    }
}

