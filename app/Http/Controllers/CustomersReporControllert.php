<?php

namespace App\Http\Controllers;

use App\Models\invices;
use App\Models\sections;
use Illuminate\Http\Request;

class CustomersReporControllert extends Controller
{
    public function index(){

        $sections = sections::all();
        return view('report.customer_report',['sections' =>$sections]);

      }


      public function Search_customers(Request $request){


  // في حالة البحث بدون التاريخ

       if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {


        $invoices = invices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
        $sections = sections::all();
         return view('report.customer_report',['sections'=>$sections])->withDetails($invoices);


       }


    // في حالة البحث بتاريخ

       else {

         $start_at = date($request->start_at);
         $end_at = date($request->end_at);

        $invoices = invices::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
         $sections = sections::all();
         return view('reports.customers_report',['sections'=>$sections])->withDetails($invoices);


       }



      }
}
