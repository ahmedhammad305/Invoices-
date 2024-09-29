<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\invices;
use App\Models\sections;
use Illuminate\Http\Request;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class InvicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
{

$this->middleware('permission:الفواتير', ['only' => ['index']]);

}
    public function index()
    {
        $invices = invices::all();
      return view('invices.invices',['invices'=>$invices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $section = sections::all();
        return view('invices.Add_Invices',['sections'=>$section]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        invices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
        // $invoice_id = invices::latest()->first()->id;
        // $user = User::get();
        // $invoices = invices::latest()->first();

        // Notification::send($user, new AddInvoice($invoices));


        return to_route('invices.com');
    }



        public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invices  $invices
     * @return \Illuminate\Http\Response
     */
    public function Status_Show($postid)
    {
        $invices = invices::findOrFail($postid);
        return view('invices.Status_Update',['invoices' => $invices]);

    }

    public function Status_Update($id, Request $request)
    {
        $invoices = invices::findOrFail($id);

        if ($request->Status === 'مدفوعة') {

            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
        }

        else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
        }
        session()->flash('Status_Update');
        return to_route('invices.com');

    }

    public function Invoice_Paid()
    {
        $invoices = invices::where('Value_Status', 1)->get();
        return view('invices.invoices_paid',['invoices'=> $invoices]);
    }

    public function Invoice_unPaid()
    {
        $invoices = invices::where('Value_Status',2)->get();
        return view('invices.Invoice_unPaid',['invoices' =>$invoices]);
    }
    public function invoices_Partial()
    {
        $invoices = invices::where('Value_Status',3)->get();
        return view('invices.Invoice_unPaid',['invoices' =>$invoices]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invices  $invices
     * @return \Illuminate\Http\Response
     */
    public function edite($postid)
    {
        $invices = invices::findOrFail($postid);
        $sections = sections::all();
        return view('invices.editeInvices',['invoice' => $invices, 'sections'=>$sections]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invices  $invices
     * @return \Illuminate\Http\Response
     */
    public function updatee(Request $request, $id)
    {
        $invoices = invices::findOrFail($id);
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);
        return to_route('invices.com');
    }

    public function new($invoices_id)
    {
        $invices = invices::findOrFail($invoices_id);
        return view('invices.Print_Invoices',['invoices' => $invices]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invices  $invices
     * @return \Illuminate\Http\Response
     */
    public function delete($postid)
    {
        $invices = invices::find($postid);
        $invices->delete();
        return to_route('invices.com');
    }
}
