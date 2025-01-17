<?php

namespace App\Http\Controllers;

use App\Models\invices;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view ('report.invoices_Report');
    }

    public function Search_invoices(Request $request){

        $rdio = $request->rdio;


     // في حالة البحث بنوع الفاتورة

        if ($rdio == 1) {


     // في حالة عدم تحديد تاريخ
            if ($request->type && $request->start_at =='' && $request->end_at =='') {

                $invoices = invices::select('*')->where('Status','=',$request->type)->get();
                $type = $request->type;
                return view('report.invoices_Report',['type'=>$type])->withDetails($invoices);
            }

            // في حالة تحديد تاريخ استحقاق
            else {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = invices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
                return view('report.invoices_Report',['type' =>$type,'start_at' =>$start_at,'end_at'=>$end_at])->withDetails($invoices);

            }



        }

    //====================================================================

    // في البحث برقم الفاتورة
        else {

            $invoices = invices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
            return view('report.invoices_Report')->withDetails($invoices);

        }



        }

}
