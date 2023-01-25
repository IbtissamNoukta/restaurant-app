<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ReportController extends Controller
{
    //
    //user do nt see the category if isn't connected
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view("reports.index");
    }

    public function generate(Request $request){
        //validation
        $this->validate($request,[
            "from" => "required",
            "to" => "required"
        ]);
        //get date
        //database dd-mm-yyyy 00:00:00 but $request dd/mm/yyyy
        $startDate = date("Y-m-d H:i:s",strtotime($request->from."00:00:00"));
        $endDate = date("Y-m-d H:i:s",strtotime($request->to."23:59:59"));
        $sales = Sale::whereBetween("created_at",[$startDate,$endDate])
                    ->where("payment_status","Paid")->get();
        return view("reports.index")->with([
            "startDate" => $startDate,
            "endDate" => $endDate,
            "total" => $sales->sum("total_price"),
            "sales" => $sales
        ]);
    }

    public function export(Request $request){
       return Excel::download(new SalesExport($request->from,$request->to), "sales.xlsx");
    }
}
