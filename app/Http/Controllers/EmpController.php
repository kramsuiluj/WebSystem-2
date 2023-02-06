<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Models\Sales;
class EmpController extends Controller
{
    public function getReceipts(){
        $data = receipt::all();
        return view('downloadReceipt', compact('data'));

    }
    public function downloadPDF(Request $request){
        $data = receipt::where('receiptfor', $request->receipt_for)
                ->get();
        if($request->receipt_for == 'supplier'){
        $pdf=PDF::loadView('downloadReceipt', compact('data'))->setOptions(['defaultFont' => 'arial']);
        }else{
        $pdf=PDF::loadView('admin.customerReceipt', compact('data'))->setOptions(['defaultFont' => 'arial']);
        }

        return $pdf->download('data.pdf');

    }

    public function downloadSales(){


        $data = sales::select(
            // [sales::raw("SUM(product_fee) as product_fee, MONTHNAME(created_at) as month_name, MAX(reserved_qty) as reserved_qty"),'products','kg']
            [sales::raw("SUM(product_fee) as product_fee, SUM(kg) as kg, MONTHNAME(created_at) as month_name, MAX(reserved_qty) as reserved_qty"),'products']
        )->whereYear('created_at', date("Y"))
        ->orderBy('created_at', 'asc')
        ->groupBy('month_name')
        ->get();
        // return view('admin.downloadSales', compact('data'));
        // ->setOptions(['defaultFont' => 'arial']);

        $pdf=PDF::loadView('admin.downloadSales', compact('data'));

//        dd(true);

        return $pdf->download('data.pdf');
    }
}
