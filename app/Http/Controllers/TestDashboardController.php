<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestDashboardController extends Controller
{
    public function __invoke()
    {
        $formattedDate = Carbon::createFromDate(request('date'))->format('m/d/Y');
        $formattedFrom = Carbon::createFromDate(request('from'))->format('m/d/Y');
        $formattedTo = Carbon::createFromDate(request('to'))->format('m/d/Y');

//        dd(Sales::whereBetween('date', [$formattedFrom, $formattedTo])->filter(request(['search']))->get());
//        dd(Carbon::parse('January')->month);
//        dd(Sales::whereMonth('created_at', '=', Carbon::parse('January')->month)->get());

        if (empty(request('month')) && empty(request('search')) && (empty(request('date')) && empty(request('from')))) {
            $sales = Sales::all();
        } elseif (empty(request('month')) && empty(request('from')) && empty(request('date'))) {
            $sales = Sales::filter(request(['search']))->get();
        } elseif (request('from')) {
            $sales = Sales::whereBetween('date', [$formattedFrom, $formattedTo])->filter(request(['search']))->get();
        } elseif (request('date')) {
            $sales = Sales::where('date', '=', $formattedDate)->filter(request(['search']))->get();
        } elseif(request('month')) {
            $salesDates = Sales::all();

            $sales = [];

            foreach ($salesDates as $salesDate) {
                if (Carbon::parse(request('month'))->month == Carbon::parse($salesDate->date)->month) {
                    if (Carbon::parse($salesDate->date)->year == request('year')) {
                        array_push($sales, $salesDate);
                    }
                }
            }

//            dd($sales);
        }


        return view('admin.test.dashboard', [
            'sales' => $sales
        ]);
    }
}
