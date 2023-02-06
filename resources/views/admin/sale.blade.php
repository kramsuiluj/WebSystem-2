<!DOCTYPE html>
<html lang="en">
<head>

    <base href="/public">

    @include("admin.admincss")
    <link href="{{ asset('css/apps.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body>
<div class="container-scroller">
    <div class="row">
        <div class="col-lg-3">
            @include("admin.navbar")
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row">
        @if(Auth::user()->access_level == 2)
            <div class="flex space-x-2">
                <div class='mt-3 mb-2'>
                    <a href="{{ route('sales.index') }}" class="btn btn-m btn-success" style="border-radius:10px;">DOWNLOAD
                        SALES</a>
                </div>
                <div class='mt-3 mb-2'>
                    <a href="{{ route('products.index') }}" class="btn btn-m btn-info" style="border-radius:10px;
                    ">DOWNLOAD
                        STOCKS</a>
                </div>
            </div>
        @endif
            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-success  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Available Products
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><h3
                                        class="mb-0">{{$store_quantity}}  </h3></div>
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-clipboard-list fa-3x text-gray"></i> -->
                                <i class="fas fa-cubes fa-3x text-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-success  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Approved Reservations
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><h3
                                        class="mb-0">{{$approved_reservation}}</h3></div>
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-clipboard-list fa-3x text-gray"></i> -->
                                <i class="fas fa-truck fa-3x text-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-success  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Total Customers
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><h3
                                        class="mb-0">{{$total_user}}</h3></div>
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-clipboard-list fa-3x text-gray"></i> -->

                                <!-- <i class="fas fa-warehouse  "></i> -->
                                <i class="fas fa-users fa-3x text-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-success  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Revenue current
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><h3 class="mb-0">
                                        ₱ {{$total_sale}}</h3></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-3x text-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-success  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Store Stock Products
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><h3
                                        class="mb-0"> {{$total_product}}</h3></div>
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-clipboard-list fa-3x text-gray"></i> -->
                                <i class="fas fa-store fa-3x text-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-success  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Warehouse Stock Products
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><h3
                                        class="mb-0"> {{$total_products}}</h3></div>
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-clipboard-list fa-3x text-gray"></i> -->
                                <!-- <i class="fas fa-warehouse-alt fa-3x text-gray"></i> -->
                                <i class="fas fa-warehouse  fa-3x text-gray"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-success  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Pending Reservations
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><h3
                                        class="mb-0"> {{$pending_reservation}}</h3></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-3x text-gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-success  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Total Sold Products
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><h3
                                        class="mb-0"> {{$total_sales}}</h3></div>
                            </div>
                            <div class="col-auto">
                                <!-- <i class="fas fa-clipboard-list fa-3x text-gray"></i> -->
                                <i class="fas fa-cubes fa-3x text-gray"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
   
            <!-- <div class="col-lg-6 mb-5">
                <div class="card card card-raised h-100  ">
                    <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
                        <i class="fas fa-chart-area me-1 text-white"></i>
                        Monthly Sales
                    </div>
                    <div class="card-body bg-white">
                        <canvas id="myAreaChart" width="100%" height="40">
                        <div class="col-lg-12 ">
                            <div id="myAreaChart1" class="mt-4" style="height: 300px;">
                                {!! $usersChart1->container() !!}
                                <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js
                                        charset=utf-8></script>
                                {!! $usersChart1->script() !!}
                            </div>
                        </div>
                        </canvas>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 mb-5">
                <div class="card card card-raised h-100 bg- ">
                    <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
                        <i class="fas fa-chart-area me-1 text-white"></i>
                        Daily Sales
                    </div>
                    <div class="card-body bg-white">
                        <canvas id="myAreaChart" width="100%" height="40">
                        <div class="col-lg-12 ">
                            <div id="myAreaChart" class="mt-4" style="height: 300px;">
                                {!! $usersChart->container() !!}
                                <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js
                                        charset=utf-8></script>
                                {!! $usersChart->script() !!}
                            </div>
                        </div>
                        </canvas>
                    </div>

                </div>
            </div> -->

<!-- {{--            <section x-data="{ show: false }" class="relative" style="width: 10rem">--}}
{{--                <button id="selectedType" @click="show = !show" class="border border-green-600 bg-green-600 w-full px-3--}}
{{--                py-1--}}
{{--                rounded-md text-white">Monthly--}}
{{--                </button>--}}

{{--                <div x-show="show" style="display: none" class="absolute z-20 border border-gray-300 bg-gray-50">--}}
{{--                    <div class="flex flex-col" style="padding-left: 0px; margin-bottom: 0px">--}}
{{--                        <a href="{{ route('dashboard') }}?type=weekly" style="text-decoration: none" id="weekly"--}}
{{--                           class="px-5 py-1--}}
{{--                        border-b--}}
{{--                        cursor-pointer--}}
{{--                        hover:bg-green-200">Weekly</a>--}}
{{--                        <a href="{{ route('dashboard') }}?type=monthly" style="text-decoration: none" id="monthly"--}}
{{--                           class="px-5 py-1 border-b--}}
{{--                        cursor-pointer--}}
{{--                        hover:bg-green-200">Monthly</a>--}}
{{--                        <a href="{{ route('dashboard') }}?type=yearly" style="text-decoration: none" id="yearly" class="px-5 py-1--}}
{{--                        cursor-pointer--}}
{{--                        hover:bg-green-200">Yearly</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}} -->

            <div class="mb-5">
                <div class="card card card-raised h-100">
                    <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
                        <i class="fas fa-chart-area me-1 text-white"></i>
                        Monthly Sales by Product
                    </div>
                    <div class="card-body bg-white">
                        <div class="col-lg-12 ">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 mb-5">
                <div class="card card card-raised h-100">
                    <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
                        <i class="fas fa-chart-area me-1 text-white"></i>
                        Yearly Sales by Product
                    </div>
                    <div class="card-body bg-white">
                        <div class="col-lg-12 ">
                            <div>
                                <canvas id="yearlyChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div
                id="yearlySales"
                style="display: none"
                data-first="{{ collect($yearlySales['first']) }}"
                data-second="{{ collect($yearlySales['second']) }}"
                data-current="{{ collect($yearlySales['current']) }}"
                data-fourth="{{ collect($yearlySales['fourth']) }}"
                data-fifth="{{ collect($yearlySales['fifth']) }}"
            >
            </div>

            <div
                id="years"
                style="display: none"
                data-years="{{ collect($years) }}"
            >
            </div>

            <div
                id="actualYears"
                style="display: none"
                data-years="{{ collect($actualYears) }}"
            >
            </div>

            <div class="col-lg-6 mb-5">
                <div class="card card card-raised h-100">
                    <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
                        <i class="fas fa-chart-area me-1 text-white"></i>
                        Weekly Sales by Product
                    </div>
                    <div class="card-body bg-white">
                        <div class="col-lg-12 ">
                            <div>
                                <canvas id="weeklyChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div id="productLabels" style="display: none" data-labels="{{ json_encode($products) }}">
            </div>

            <div
                id="sales"
                style="display: none"
                data-january="{{ json_encode($salesMonth['January']) }}"
                data-february="{{ collect($salesMonth['February']) }}"
                data-march="{{ collect($salesMonth['March']) }}"
                data-april="{{ collect($salesMonth['April']) }}"
                data-may="{{ collect($salesMonth['May']) }}"
                data-june="{{ collect($salesMonth['June']) }}"
                data-july="{{ collect($salesMonth['July']) }}"
                data-august="{{ collect($salesMonth['August']) }}"
                data-september="{{ collect($salesMonth['September']) }}"
                data-october="{{ collect($salesMonth['October']) }}"
                data-november="{{ collect($salesMonth['November']) }}"
                data-december="{{ collect($salesMonth['December']) }}"
            >
            </div>

            <div
                id="weeklySales"
                style="display: none"
                data-first="{{ collect($weeklySales['first']) }}"
                data-second="{{ collect($weeklySales['second']) }}"
                data-third="{{ collect($weeklySales['third']) }}"
                data-fourth="{{ collect($weeklySales['fourth']) }}"
            >
            </div>
        </div>
    </div>

    @include("admin.adminscript")

</div>

<script>
    const sales = Object.assign({}, document.getElementById('sales').dataset) ?? null;
    console.log(document.getElementById('yearlySales'));
    const yearlySales = document.getElementById('yearlySales') != null ? Object.assign({}, document
        .getElementById('yearlySales').dataset) : null;
    const weeklySales = Object.assign({}, document.getElementById('weeklySales').dataset) ?? null;
    const years = document.getElementById('years') != null ? Object.assign({}, document.getElementById('years').dataset)
        : null;
    const actualYears = document.getElementById('actualYears') != null ? Object.assign({}, document.getElementById
    ('actualYears').dataset) : null;
    const productLabels = Object.assign({}, document.getElementById('productLabels').dataset) ?? null;
    // const selectedType = document.getElementById('selectedType') ?? null;
    // const weekly = document.getElementById('weekly') ?? null;
    // const monthly = document.getElementById('monthly') ?? null;
    // const yearly = document.getElementById('yearly') ?? null;
    const ctx = document.getElementById('myChart') ?? null;
    const ctxYear = document.getElementById('yearlyChart') ?? null;
    const ctxWeek = document.getElementById('weeklyChart') ?? null;

    const colors = ['#A3E635', '#65A30D', '#365314', '#4ADE80', '#16A34A', '#14532D', '#34D399', '#059669', '#064E3B']

    const dataset = JSON.parse(productLabels.labels).map(function (product, index) {
        var color;

        for (let i = 0; i < colors.length; i++) {
            if (i === index) {
                color = colors[i];
            }
        }

        return {
            label: product,
            backgroundColor: color,
            data: [
                JSON.parse(sales.january)[product], JSON.parse(sales.february)[product], JSON.parse(sales.march)
                    [product], JSON.parse(sales.april)[product], JSON.parse(sales.may)[product], JSON.parse(sales.june)
                    [product], JSON.parse(sales.july)[product], JSON.parse(sales.august)[product], JSON.parse(sales
                    .september)
                    [product], JSON.parse(sales.october)[product], JSON.parse(sales.november)[product], JSON.parse(sales.december)[product]
            ]
        }
    });

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'],
            datasets: dataset,
        },
        options: {
            barValueSpacing: 20,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        min: 1
                    }
                }
            }
        }
    });

    const dataset2 = JSON.parse(productLabels.labels).map(function (product, index) {
        var color;

        for (let i = 0; i < colors.length; i++) {
            if (i === index) {
                color = colors[i];
            }
        }

        return {
            label: product,
            backgroundColor: color,
            data: [
                JSON.parse(JSON.parse(yearlySales['first'])[product]),
                JSON.parse(JSON.parse(yearlySales['second'])[product]),
                JSON.parse(JSON.parse(yearlySales['current'])[product]),
                JSON.parse(JSON.parse(yearlySales['fourth'])[product]),
                JSON.parse(JSON.parse(yearlySales['fifth'])[product])
            ]
        }
    }) ?? null;

    new Chart(ctxYear, {
        type: 'bar',
        data: {
            labels: JSON.parse(actualYears.years),
            datasets: dataset2,
        },
        options: {
            barValueSpacing: 20,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        min: 1
                    }
                }
            }
        }
    }) ?? null;

    const dataset3 = JSON.parse(productLabels.labels).map(function (product, index) {
        var color;

        for (let i = 0; i < colors.length; i++) {
            if (i === index) {
                color = colors[i];
            }
        }

        return {
            label: product,
            backgroundColor: color,
            data: [
                JSON.parse(JSON.parse(weeklySales['first'])[product]),
                JSON.parse(JSON.parse(weeklySales['second'])[product]),
                JSON.parse(JSON.parse(weeklySales['third'])[product]),
                JSON.parse(JSON.parse(weeklySales['fourth'])[product])
            ]
        }
    });

    new Chart(ctxWeek, {
        type: 'bar',
        data: {
            labels: ['First Week', 'Second Week', 'Third Week', 'Fourth Week'],
            datasets: dataset3,
        },
        options: {
            barValueSpacing: 20,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        min: 1
                    }
                }
            }
        }
    });
</script>
</body>
</html>

