<?php

namespace App\Exports;

use App\Sale;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExport implements FromView
{
    private $from;
    private $to;
    private $sales;
    private $total;

    public function __construct($from,$to){
        $this->from = $from;
        $this->to = $to;
        $this->sales = $sales = Sale::whereBetween("created_at",[$from,$to])
        ->where("payment_status","Paid")->get();;
        $this->total = $this->sales->sum("total_price");
    }

    public function view(): View
    {
        return view('reports.export', [
            'total' => $this->total,
            'sales' => $this->sales,
            'from' => $this->from,
            'to' => $this->to

        ]);
    }
}
