<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TestDashboardController;
use App\Mail\NotifyMail;
use App\Models\Sales;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\EmpController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TbladdressController;
use Illuminate\Support\Carbon;

Route::get("/", [HomeController::class, "index"]);


Route::get("/productmenu", [AdminController::class, "productmenu"]);
Route::get("/product", [HomeController::class, "product"]);
Route::get("/staffs", [HomeController::class, "staffs"]);
Route::get("/reservation", [HomeController::class, "reservation"]);
// Route::post("/reservation",[HomeController::class,"reservation"]);

Route::get("/content", [AdminController::class, "index"]);

Route::get("/checkbox", [HomeController::class, "checkbox"]);

Route::get("/sale", [AdminController::class, "sale"]);

Route::post("/cancelReserve", [HomeController::class, "cancelReserve"]);

Route::get("/users", [AdminController::class, "user"]);

Route::get("/deletemenu/{id}", [AdminController::class, "deletemenu"]);

Route::get("/updateview/{encryption_id}", [AdminController::class, "updateview"]);

Route::post("/update/{id}", [AdminController::class, "update"]);

Route::post("/reservation", [AdminController::class, "reservation"]);


Route::get("/viewreservation", [AdminController::class, "viewreservation"]);

Route::get("/viewstaffs", [AdminController::class, "viewstaffs"]);

Route::post("/uploadstaffs", [AdminController::class, "uploadstaffs"]);
Route::get("/get_staff", [AdminController::class, "get_staff"]);


Route::get("/updatestaffs/{encryption_id}", [AdminController::class, "updatestaffs"]);

Route::post("/updatestaff/{id}", [AdminController::class, "updatestaff"]);

Route::get("/deletestaff/{id}", [AdminController::class, "deletestaff"]);


Route::post("/addcart/{id}", [HomeController::class, "addcart"]);

Route::post("/offers", [HomeController::class, "offers"]);

Route::get("/showcart/{encryption_id}", [HomeController::class, "showcart"]);


Route::get("/productmenu", [AdminController::class, "productmenu"]);
Route::get("/get_product", [AdminController::class, "get_product"]);

Route::post("/uploadproduct", [AdminController::class, "upload"]);

Route::get("/deleteuser/{id}", [AdminController::class, "deleteuser"]);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get("/redirects", [HomeController::class, "redirects"])->middleware('auth', 'verified');

Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::post('/sales/result', function () {
    $selectedDates = '';
//    dd(request()->all());

    if (request('search') == '' && request('date') == '') {
        $selectedDates = 'All Time';
    }

    if (request('range') && request('range') !== '|') {
        $dates = explode('|', request('range'));
        $selectedDates = Carbon::parse($dates[0])->format('M d, Y') . ' - ' . Carbon::parse($dates[1])->format('M d, Y');
    }

    if (request('date')) {
        $selectedDates = Carbon::parse(request('date'))->format('M d, Y');
    }

    if (request('year') && request('year') !== '|') {
        $selectedDates = (request('year') - 2) . ' - ' . request('year');
        $pastYears = (request('year') - 2);
        $presentYear = request('year');
    }

    if (request('monthly')) {
        $selectedDates = 'Months of ' . request('monthly');
    }

    if (request('weekly') && request('weekly') !== '|') {
//        $selectedDates = 'Weeks of ' . request('weekly');
        $months = ['January' => '1', 'February' => '2', 'March' => '3', 'April' => '4', 'May' => '5', 'June' => '6', 'July' => '7', 'August' => '8', 'September' => '9', 'October' => '10', 'November' => '11', 'December' => '12'];
        $selectedDates = explode('|', request('weekly'));
        $year = $selectedDates[0];
        $month = $selectedDates[1];
        foreach ($months as $key => $value) {
            if ($month == $value) {
                $month = $key;
            }
        }

        $selectedDates = 'Weeks of ' . $month . ' ' . $year;
    }

    if (request('daily')) {
        $selectedDates = 'Previous 6 Days from ' . Carbon::parse(request('date'))->format('M d, Y');
    }

//    dd($selectedDates);

//    dd(collect(json_decode(request('sales'))));

    $data = collect(json_decode(request('sales'), true))->sortByDesc('reserved_qty')->sortBy(function($a, $b){
        return Carbon::parse($a['date'])->format('m');
    });


    return view('admin.downloadSales', compact('data', 'selectedDates'));
});

Route::post('/products/result', function () {
    $data = collect(json_decode(request('products'), true))
                                ->where('warehouse_quantity', '!=', 0)
                                ->where('store_quantity', '!=', 0);

    return view('admin.products.print', compact('data'));
});

Route::get('/downloads/sales', function () {
    $data = sales::select(
    // [sales::raw("SUM(product_fee) as product_fee, MONTHNAME(created_at) as month_name, MAX(reserved_qty) as reserved_qty"),'products','kg']
        [sales::raw("SUM(product_fee) as product_fee, SUM(kg) as kg, MONTHNAME(created_at) as month_name, MAX(reserved_qty) as reserved_qty"), 'products']
    )->whereYear('created_at', date("Y"))
        ->orderBy('created_at', 'asc')
        ->groupBy('month_name')
        ->get();

    return view('admin.downloadSales', compact('data'));
});

Route::get("/bar-chart", [HomeController::class, "barChart"]);
Route::get("/bar-chart2", [AdminController::class, "barChart2"]);
Route::get("/downloadReceipt", [EmpController::class, "getReceipts"]);

Route::post("/downloadPDF", [EmpController::class, "downloadPDF"]);

Route::get("/supplyreceipt", [AdminController::class, "supplyreceipt"]);

Route::post("/uploadreceipt", [AdminController::class, "uploadreceipt"]);

Route::post("/removeReceipt", [AdminController::class, "removeReceipt"]);
Route::post("/refno", [HomeController::class, "refno"]);
Route::get("/managereservation/{user_id}", [AdminController::class, "manageReserve"]);
Route::post("/pending/{encryption_id}", [AdminController::class, "pending"]);
// Approve/Disapprove Reservation of users
Route::get("/deleteReserve/{user_id}", [AdminController::class, "deleteReserve"]);
Route::post("/approveReserve", [AdminController::class, "approveReserve"]);
Route::post("/viewApproved/{encryption_id}", [AdminController::class, "viewApproved"]);
Route::post("/delivered", [AdminController::class, "delivered"]);

Route::get("/notifmail", function () {
    Mail::to('rjfriceservation@gmail.com')
        ->send(new NotifyMail);
});

Route::get("/manageuser/{encryption_id}", [AdminController::class, "manageuser"]);
Route::post("/updateAccess/{id}", [AdminController::class, "updateAccess"]);
Route::get("/removeAccess/{id}", [AdminController::class, "removeAccess"]);
Route::post("/ins_loc_img/{user_id}", [AdminController::class, "ins_loc_img"]);
Route::post("/sold_from_walkin", [AdminController::class, "sold_from_walkin"]);

Route::get("/req_discount", [HomeController::class, "req_discount"]);
Route::post("/set_discount", [AdminController::class, "set_discount"]);
Route::get("/no_discount/{user_id}", [AdminController::class, "no_discount"]);

Route::get("/get_reserve/{prod_id}", [HomeController::class, "get_reserve"]);
Route::post("/updateReserve", [HomeController::class, "updateReserve"]);

Route::post("/set_ref", [HomeController::class, "set_ref"]);

Route::get("/downloadSales", [EmpController::class, "downloadSales"])->name('download.sales');

Route::get("/walkin", [AdminController::class, "walkin"]);

Route::post('/onupdate_load_address', [TbladdressController::class, 'onupdate_load_address']);
Route::post('/onselect_city_load_brgy', [TbladdressController::class, 'onselect_city_load_brgy']);
Route::get('/loadbrgy', [TbladdressController::class, 'loadbrgy']);

Route::post("/set_qr/{id}", [AdminController::class, "set_qr"]);

Route::get('/showDetails',[AdminController::class, 'showDetails']);
