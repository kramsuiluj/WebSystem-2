<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $formattedDate = Carbon::createFromDate(request('date'))->format('m/d/Y');
        $formattedFrom = Carbon::createFromDate(request('from'))->format('m/d/Y');
        $formattedTo = Carbon::createFromDate(request('to'))->format('m/d/Y');

        if (empty(request('daily')) && empty(request('wYear')) && empty(request('monthly')) && empty(request('search')) && empty(request('year')) && (empty(request('date')) && empty(request('from')))) {
            $sales = Sales::all();
        } elseif (empty(request('daily')) && empty(request('wYear')) && empty(request('monthly')) && empty(request('from')) && empty(request('date')) && empty(request('year'))) {
            $sales = Sales::filter(request(['search']))->get();
        } elseif (request('from')) {
            $salesDates = Sales::all();

            $sales = [];

            foreach ($salesDates as $salesDate) {
                if($salesDate->date->gte($formattedFrom) && $salesDate->date->lte($formattedTo)) {
                    array_push($sales, $salesDate);
                }
            }
        } elseif (request('date')) {
            $sales = Sales::where('date', '=', $formattedDate)->filter(request(['search']))->get();
        } elseif(request('monthly')) {
            $salesDates = Sales::all();
            $months = ['January' => '1', 'February' => '2', 'March' => '3', 'April' => '4', 'May' => '5', 'June' => '6', 'July' => '7', 'August' => '8', 'September' => '9', 'October' => '10', 'November' => '11', 'December' => '12'];

            $sales = [

            ];

            foreach ($salesDates as $salesDate) {
                if(request('monthly') == Carbon::parse($salesDate->date)->year) {
                    foreach ($months as $key => $value) {
                        if ($value == Carbon::parse($salesDate->date)->month) {
                            array_push($sales, $salesDate ?? '');
                        }
                    }
                }
            }

        } elseif(request('year')) {
            $salesDates = Sales::all();

            $years = [
                \request('year') - 2,
                \request('year') - 1,
                \request('year') - 0
            ];

            $sales = [];

            foreach ($years as $year) {
                foreach ($salesDates as $salesDate) {
                    if ($year == Carbon::parse($salesDate->date)->year) {
                        array_push($sales, $salesDate);
                    }
                }
            }
        } elseif(request('wYear')) {
            $salesDates = Sales::all();
            $sales = [];

            foreach ($salesDates as $salesDate) {
                if (request('wYear') == Carbon::parse($salesDate->date)->year) {
                    if (request('wMonth') == Carbon::parse($salesDate->date)->month) {
                        array_push($sales, $salesDate);
                    }
                }
            }
        } elseif(request('daily')) {
            $salesDates = Sales::all();
            $sales = [];

            $days = [
                $dates = Carbon::parse(request('daily'))->subDays(6)->toDateString(),
                $dates = Carbon::parse(request('daily'))->subDays(5)->toDateString(),
                $dates = Carbon::parse(request('daily'))->subDays(4)->toDateString(),
                $dates = Carbon::parse(request('daily'))->subDays(3)->toDateString(),
                $dates = Carbon::parse(request('daily'))->subDays(2)->toDateString(),
                $dates = Carbon::parse(request('daily'))->subDays(1)->toDateString(),
                $dates = Carbon::parse(request('daily'))->toDateString(),
            ];
            foreach ($salesDates as $salesDate) {
                foreach ($days as $day) {
                    if (Carbon::parse($salesDate->date)->toDateString() == $day) {
                        array_push($sales, $salesDate);
                    }
                }
            }
        }

        if(request('delete')) {
            Sales::find(request('delete'))->delete();

            return redirect(route('sales.index'));
        }

        return view('admin.sales.index', [
            'sales' => collect($sales)
        ]);
    }

}
