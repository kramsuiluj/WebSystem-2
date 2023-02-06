<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Cart;
use App\Models\Code;
use App\Models\User;
use App\Models\Kilos;

use App\Models\Sales;
use App\Models\Staffs;


use App\Models\Content;
use App\Models\Product;
use App\Mail\NotifyMail;
use App\Charts\UserChart;
use App\Models\Reservation;
use App\Models\Refbrgy;
use App\Models\refcitymun;
use App\Models\refprovince;


use Carbon\CarbonInterval;
use Carbon\Traits\Date;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use Ramsey\Collection\Collection;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;


class HomeController extends Controller
{
    public function index()
    {

        if (Auth::id()) {
            return redirect('redirects');
        } else

            $data = product::all();

        $data2 = staffs::all();
        return view("home", compact("data", "data2"));
    }


    public function redirects()
    {
        $data = product::all();

        $data2 = staffs::all();

        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {

            {
                $total_product = product::all()->count();
                $store_quantity = product::all()->count();
                $total_user = user::where('access_level', '0')->count();
                $product = product::all();
                $products = product::all();
                $reservation = reservation::all();
                $sale = Sales::all();
                $pending_reservation = reservation::where('status', 'pending')
                    ->where('buy_option', '!=', '')
                    ->groupby('user_id')
                    ->count();
                $approved_reservation = reservation::where('status', 'approved')->count();

                $current_revenue = sales::select(DB::raw("sum(product_fee) as sale"))
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->get();
                $total_sale = 0;

                foreach ($current_revenue as $current_revenue) {
                    $total_sale += $current_revenue->sale;
                }

                $total_product = 0;

                foreach ($product as $product) {
                    $explode_store = explode('.', $product->store_quantity);
                    for ($i = 0; $i < count($explode_store); $i++) {
                        $total_product += $explode_store[$i];
                    }

                }
                $total_products = 0;
                foreach ($products as $products) {
                    $explode_ware = explode('.', $products->warehouse_quantity);
                    for ($i = 0; $i < count($explode_ware); $i++) {
                        $total_products += $explode_ware[$i];
                    }
                }
                $total_sales = 0;

                foreach ($sale as $sale) {
                    $total_sales = $total_sales + $sale->reserved_qty;
                }

                $saleData1 = sales::select(DB::raw("sum(product_fee) as product_fee"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('product_fee')
                    ->toJson();

                $saleData = array_map('intval', json_decode($saleData1, true));
                $optionValue = product::all()->count();
            }

            $now = Carbon::now();
            $yr = $now->format('Y/m/d');

            $usersChart = new UserChart;
            $usersChart->labels(['Jan', 'Feb', 'Mar']);
            $usersChart->dataset('Users by trimester', 'line', [10, 25, 13]);

            //monthly
            {
                $m = $now->format('m');
                $date_start = Carbon::create(date('Y'), "1");//january start
                $data = [];
                $monthdata = [];
                $x = 0;

                for ($month = $m; $x <= 7; $month++) {
                    $x = $x + 1;
                    $date = Carbon::create(date('Y'), $month);
                    $date_end = $date->copy()->endOfMonth();

                    $saledate = DB::table('sales')
                        ->select(DB::raw('sum(product_fee) as sale'))
                        ->where('created_at', '>=', $date)
                        ->where('created_at', '<=', $date_end)
                        ->get();

                    $sum = 0;
                    foreach ($saledate as $row) {
                        $sum = $row->sale;
                    }
                    array_push($data, $sum);
                    array_push($monthdata, $date->format('M'));

                }

                $usersChart1 = new UserChart;
                $usersChart1->labels($monthdata);
                $usersChart1->dataset('Sales', 'bar', $data)->options([
                    'color' => '#2596be',
                ]);
            }
            //daily
            {
                $m = $now->format('m');
                $dayNo = $now->format('d');
                $date_start = Carbon::create(date('Y-m-d'));//january start


                // dd($date_start->format('M-d'));
                $data = [];
                $monthdata = [];
                for ($xx = 0; $xx <= 9; $xx++) {

                    $date_end = date("Y-m-d", strtotime($date_start . " + 1 days"));
                    // dd($date_end);
                    $saledate = DB::table('sales')
                        ->select(DB::raw('sum(product_fee) as sale'))
                        ->where('created_at', '>=', $date_start)
                        ->where('created_at', '<=', $date_end)
                        ->get();

                    $sum = 0;
                    foreach ($saledate as $row) {
                        $sum = $row->sale;
                    }
                    $dateLabel = date("M-d", strtotime($date_start));
                    array_push($data, $sum);
                    array_push($monthdata, $dateLabel);
                    $date_start = date("Y-m-d", strtotime($date_start . " - 1 days"));

                }
                $usersChart = new UserChart;
                $usersChart->labels($monthdata);
                $usersChart->dataset('Sales', 'bar', $data);


            }

            $products = Product::select('title')->orderBy('title')->get()->pluck('title');

            $salesJanuary = [];
            $salesFebruary = [];
            $salesMarch = [];
            $salesApril = [];
            $salesMay = [];
            $salesJune = [];
            $salesJuly = [];
            $salesAugust = [];
            $salesSeptember = [];
            $salesOctober = [];
            $salesNovember = [];
            $salesDecember = [];

            $salesMonth = [];
            $salesYearly = [];

            foreach ($products as $product) {
                $salesByProduct = Sales::where('products', $product)->get();

                foreach ($salesByProduct as $sale) {
                    if (Carbon::parse($sale->date)->month == '1' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesJanuary, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '2' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesFebruary, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '3' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesMarch, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '4' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesApril, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '5' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesMay, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '6' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesJune, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '7' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesJuly, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '8' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesAugust, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '9' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesSeptember, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '10' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesOctober, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '11' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesNovember, $sale);
                    }
                    if (Carbon::parse($sale->date)->month == '12' && Carbon::parse($sale->date)->year == Carbon::now()->year) {
                        array_push($salesDecember, $sale);
                    }
                }

                $salesMonth['January'][$product] = collect($salesJanuary)->where('products', $product)->sum('product_fee');
                $salesMonth['February'][$product] = collect($salesFebruary)->where('products', $product)->sum('product_fee');
                $salesMonth['March'][$product] = collect($salesMarch)->where('products', $product)->sum('product_fee');
                $salesMonth['April'][$product] = collect($salesApril)->where('products', $product)->sum('product_fee');
                $salesMonth['May'][$product] = collect($salesMay)->where('products', $product)->sum('product_fee');
                $salesMonth['June'][$product] = collect($salesJune)->where('products', $product)->sum('product_fee');
                $salesMonth['July'][$product] = collect($salesJuly)->where('products', $product)->sum('product_fee');
                $salesMonth['August'][$product] = collect($salesAugust)->where('products', $product)->sum('product_fee');
                $salesMonth['September'][$product] = collect($salesSeptember)->where('products', $product)->sum('product_fee');
                $salesMonth['October'][$product] = collect($salesOctober)->where('products', $product)->sum('product_fee');
                $salesMonth['November'][$product] = collect($salesNovember)->where('products', $product)->sum('product_fee');
                $salesMonth['December'][$product] = collect($salesDecember)->where('products', $product)->sum('product_fee');
            }

            $yearlySales = [];
            foreach ($products as $product) {
                $sales = Sales::where('products', $product)->get();
                $currentYearSales[$product] = [];
                $firstYear[$product] = [];
                $secondYear[$product] = [];
                $fourthYear[$product] = [];
                $fifthYear[$product] = [];

                foreach ($sales as $sale) {
                    if ($sale->date->year == Carbon::now()->year) {
                        array_push($currentYearSales[$product], $sale);
                    }
                    if ($sale->date->year == Carbon::now()->year - 2) {
                        array_push($firstYear[$product], $sale);
                    }
                    if ($sale->date->year == Carbon::now()->year - 1) {
                        array_push($secondYear[$product], $sale);
                    }
                    if ($sale->date->year == Carbon::now()->year + 1) {
                        array_push($fourthYear[$product], $sale);
                    }
                    if ($sale->date->year == Carbon::now()->year + 2) {
                        array_push($fifthYear[$product], $sale);
                    }
                }

                $yearlySales['current'][$product] = collect($currentYearSales[$product])->sum('product_fee');
                $yearlySales['first'][$product] = collect($firstYear[$product])->sum('product_fee');
                $yearlySales['second'][$product] = collect($secondYear[$product])->sum('product_fee');
                $yearlySales['fourth'][$product] = collect($fourthYear[$product])->sum('product_fee');
                $yearlySales['fifth'][$product] = collect($fifthYear[$product])->sum('product_fee');
            }

            $actualYears = [(Carbon::now()->year - 2), (Carbon::now()->year - 1), (Carbon::now()->year), (Carbon::now()->year + 1), (Carbon::now()->year + 2)];
            $years = ['first', 'second', 'current', 'fourth', 'fifth'];

            $sundays = $this->getSundays();
            $dates = [];

            foreach ($sundays as $key => $sunday) {
                $temp = [];

                $sunday = Carbon::parse($sunday)->format('m/d/Y');
                array_push($temp, $sunday);
                $monday = Carbon::parse(Carbon::parse($sunday)->addDay(1))->format('m/d/Y');
                array_push($temp, $monday);
                $tuesday = Carbon::parse(Carbon::parse($sunday)->addDay(2))->format('m/d/Y');
                array_push($temp, $tuesday);
                $wednesday = Carbon::parse(Carbon::parse($sunday)->addDay(3))->format('m/d/Y');
                array_push($temp, $wednesday);
                $thursday = Carbon::parse(Carbon::parse($sunday)->addDay(4))->format('m/d/Y');
                array_push($temp, $thursday);
                $friday = Carbon::parse(Carbon::parse($sunday)->addDay(5))->format('m/d/Y');
                array_push($temp, $friday);
                $saturday = Carbon::parse(Carbon::parse($sunday)->addDay(6))->format('m/d/Y');
                array_push($temp, $saturday);

                array_push($dates, $temp);
            }

            $weeklySales = [];
            foreach ($products as $product) {
                $sales = Sales::where('products', $product)->get();
                $weeks[0][$product] = [];
                $weeks[1][$product] = [];
                $weeks[2][$product] = [];
                $weeks[3][$product] = [];

                foreach ($sales as $key => $sale) {

                    foreach ($dates as $key => $week) {
                        if (in_array(Carbon::parse($sale['date'])->format('m/d/Y'), $week)) {
                            if ($key == 0) {
                                array_push($weeks[0][$product], $sale);
                            }
                            if ($key == 1) {
                                array_push($weeks[1][$product], $sale);
                            }
                            if ($key == 2) {
                                array_push($weeks[2][$product], $sale);
                            }
                            if ($key == 3) {
                                array_push($weeks[3][$product], $sale);
                            }
                        }
                    }
                }
                $weeklySales['first'][$product] = collect($weeks[0][$product])->sum('product_fee');
                $weeklySales['second'][$product] = collect($weeks[1][$product])->sum('product_fee');
                $weeklySales['third'][$product] = collect($weeks[2][$product])->sum('product_fee');
                $weeklySales['fourth'][$product] = collect($weeks[3][$product])->sum('product_fee');
            }

            return view('admin.sale', [
                'usersChart1' => $usersChart1,
                'usersChart' => $usersChart,
                'store_quantity' => $store_quantity,
                'approved_reservation' => $approved_reservation,
                'total_user' => $total_user,
                'total_sale' => $total_sale,
                'total_product' => $total_product,
                'total_products' => $total_products,
                'pending_reservation' => $pending_reservation,
                'total_sales' => $total_sales,
                'saleData' => $saleData,
                'optionValue' => $optionValue,
                'products' => $products ?? null,
                'salesMonth' => $salesMonth ?? null,
                'yearlySales' => $yearlySales ?? null,
                'years' => $years ?? null,
                'actualYears' => $actualYears ?? null,
                'weeklySales' => $weeklySales ?? null
            ]);

        } else {

            $user_id = Auth::id();
            $count = reservation::where('user_id', $user_id)->count();
            return view('home', compact('data', 'data2', 'count'));
        }
    }

    public function product()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
            if ($usertype == '1') {
                return redirect()->back();
            }
        }

        $data = product::where('warehouse_quantity','!=', 0)
                        ->get();
        $user_id = Auth::id();
        $user = user::where('id', $user_id)
            ->first();
        $count = reservation::where('user_id', $user_id)->count();
        $datas = product::orderby('sold', 'desc')->limit(5)->get();
        $max_sold = product::all()->max('sold');
        $prod_name = array();
        $prod_sold = array();
        foreach ($datas as $datas) {
            $prod_name[] = strtoupper($datas->title);
            $prod_sold[] = $datas->sold;
        }

        return view('product', compact('data', 'count', 'prod_name', 'prod_sold', 'max_sold', 'user'));

    }

    protected function getSundays()
    {
        return new \DatePeriod(
            Carbon::parse("first sunday of this month"),
            CarbonInterval::week(),
            Carbon::parse("first sunday of next month")
        );
    }

    protected function getSaturdays()
    {
        return new \DatePeriod(
            Carbon::parse("first saturday of this month"),
            CarbonInterval::week(),
            Carbon::parse("first saturday of next month")
        );
    }

    public function staffs()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
            if ($usertype == '1') {
                return redirect()->back();
            }
        }
        if (Auth::id()) {
            $data2 = staffs::all();
            $user_id = Auth::id();
            $count = reservation::where('user_id', $user_id)->count();
            return view('staffs', compact('data2', 'count'));
        } else {
            $data2 = staffs::all();
            return view('staffs', compact('data2'));
        }

    }

    public function reservation(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
            if ($usertype == '1') {
                return redirect()->back();
            }
        }
        $user_id = Auth::id();
        $count = reservation::where('user_id', $user_id)->count();
        $data2 = user::where('id', $user_id)
            ->first();
        $data = product::all();

        return view('reservation', compact('data', 'count', 'data2'));
    }



    public function showcart(Request $request, $encryption_id)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
            if ($usertype == '1') {
                return redirect()->back();
            }

            $encrypt_id = Crypt::decrypt($encryption_id);
            $user_id = Auth::id();

            if ($encrypt_id != $user_id) {
                return redirect()->back();
            }

            $user = user::where('id', $user_id)
                ->first();
            $admin = user::where('usertype', 1)
                ->where('access_level', 2)
                ->first();


            $count = reservation::where('user_id', $encrypt_id)
                ->count();
            $countpending = reservation::where('user_id', $encrypt_id)
                ->where('status', 'pending')
                ->where('pay_status', '0')
                ->count();
            $countapproved = reservation::where('user_id', $encrypt_id)
                ->where('status', 'approved')
                ->count();
            $counthistory = sales::where('user_id', $encrypt_id)
                ->count();
            $data = reservation::where('user_id', $encrypt_id)
                ->where('status', 'pending')
                ->where('pay_status', '0')
                ->get();

            $refno = reservation::where('user_id', $encrypt_id)
                // ->where('status','pending')
                ->first();
            $approvedrefno = reservation::where('user_id', $encrypt_id)
                ->where('status', 'approved')
                ->get();

            $dd = reservation::where('user_id', $encrypt_id)
                ->where('status', 'approved')
                ->where('pay_status', '0')
                ->get();

            $history = sales::where('user_id', $encrypt_id)
                ->where('status', 'sold')
                ->select([sales::raw('date as history_date'),'sales.*'])
                ->get();

            // dd($encrypt_id);

            return view('showcart', compact('count', 'data', 'refno', 'approvedrefno', 'history', 'countapproved', 'countpending', 'counthistory', 'user', 'admin'))->with('dd', $dd);
        } else {
            return redirect('/login');
        }
    }

    public function req_discount()
    {
        $user_id = Auth::id();
        $data = reservation::where('user_id', $user_id)
            ->where('status', 'pending')
            ->update(['discount' => 0]);

        return redirect()->back();
    }

    public function checkbox()
    {
        return view("/checkbox");
    }

    public function cancelReserve(Request $request)
    {

        $reserved_id = $request->reserved_id;
        reservation::whereIn('id', $reserved_id)->delete();
        return redirect()->back();

    }

    public function refno(Request $request)
    {
        $user_id = Auth::id();
        $user = user::where('id', $user_id)
            ->update(['address' => $request->address]);
        $barangay = DB::table('refbrgy')
            ->where('brgyCode', $request->barangay)
            ->first();
        $municipality = DB::table('refcitymun')
            ->where('citymunCode', $request->city)
            ->first();
        $province = DB::table('refprovince')
            ->where('provCode', $request->province)
            ->first();

        if ($request->buy_option == 'Deliver') {
            $address = $barangay->brgyDesc . ', ' . $municipality->citymunDesc . ', ' . $province->provDesc;
            $data = reservation::where('user_id', $user_id)
                ->where('status', 'pending')
                ->update(['refno' => $request->refno,
                    'date' => '',
                    'time' => '',
                    'address' => $address,
                    'buy_option' => $request->buy_option
                ]);
        } else {
            $data = reservation::where('user_id', $user_id)
                ->where('status', 'pending')
                ->update(['refno' => $request->refno,
                    'date' => $request->date,
                    'time' => Carbon::parse($request->input('time'))->format('h:i a'),
                    'address' => $request->buy_option,
                    'buy_option' => $request->buy_option
                ]);
        }

        $notifAdmin = reservation::where('user_id', $user_id)
            ->first();
        $details = [
            'title' => 'New user reservation',
            'body' => $notifAdmin->email . ' made a reservation today ' . $notifAdmin->updated_at,
            'url' => 'Check it Now ' . url('/')
        ];

        Mail::to('rjfriceservation@gmail.com')->send(new \App\Mail\NotifyMail($details));
        Alert::success('Product(s) Added Successfully', 'We have added your selected product(s) to the Cart');
        return redirect()->back();

    }

    public function get_reserve($prod_id)
    {

        $user_id = Auth::id();
        $user = user::where('id', $user_id)
            ->first();

        $data = product::find($prod_id);
        return response()->json([
            'status' => 200,
            'product' => $data,
            'user' => $user
        ]);
    }

    public function updateReserve(Request $request)
    {
        $checked_array = $request->input('prod_kilos', []);
        $id = $request->input('prod_id', []);
        $name = $request->input('prod_name', []);
        $qty = $request->input('reserved_qty', []);
        foreach ($checked_array as $value) {
            $calculate = reservation::where('prod_id', $id[$value])
                ->where('kg', $value)->first();
            if ($calculate->reserved_qty < $qty[$value]) {
                $reduce_to_warehouse = $qty[$value] - $calculate->reserved_qty;
                $calculate->product_fee = $calculate->price * $qty[$value];
                $calculate->reserved_qty = $qty[$value];
                $calculate->save();
            } else if ($calculate->reserved_qty > $qty[$value]) {
                $back_to_warehouse = $calculate->reserved_qty - $qty[$value];
                $calculate->product_fee = $calculate->price * $qty[$value];
                $calculate->reserved_qty = $qty[$value];
                $calculate->save();
            } else {
                $update_prod->save();
            }

        }
        $user_id = Auth::id();
        $repeat_discount = reservation::where('user_id', $user_id)
            ->where('status', 'pending')
            ->where('discount', 1)
            ->get();
        foreach ($repeat_discount as $repeat_discount) {
            $repeat_discount->product_fee = $repeat_discount->reserved_qty * $repeat_discount->price;
            $repeat_discount->discount = 0;
            $repeat_discount->save();
        }


        return redirect()->back();

    }

    public function set_ref(Request $request)
    {
        $user_id = Auth::id();

        $invoiceNo = Str::random(10);

        $image = $request->image;

        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('qr_imgs', $imagename);

        $data = reservation::where('user_id', $user_id)
            ->where('status', 'approved')
            ->where('refno', null)
            ->update(['refno' => $request->refno,
                'invoiceNo' => $invoiceNo,
                'qr' => $imagename,]);
        return redirect()->back();



    }

}
