<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Sales Report</title>
    {{--    @include("admin.admincss")--}}
    {{--    <link href="{{ asset('css/apps.css') }}" rel="stylesheet">--}}
    {{--    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">--}}
</head>
<body>

{{--<form action="" method="GET" class="">--}}
{{--    <div class="flex flex-col">--}}
{{--        <div class="relative" style="width: 10rem">--}}
{{--            <button type="button" id="selectType" class="border border-gray-300 bg-gray-200 px-2 w-full">Exact</button>--}}

{{--            <div id="type" style="display:none;" class="border border-gray-300 bg-gray-100 absolute w-full">--}}
{{--                <ul>--}}
{{--                    <li id="exact" class="cursor-pointer">Exact</li>--}}
{{--                    <li id="range" class="cursor-pointer">Range</li>--}}
{{--                    <li id="month" class="cursor-pointer">Month</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div style="" id="exact_fields">--}}
{{--            <label for="">Exact Date</label>--}}
{{--            <input type="date" name="date" class="border border-gray-300 p-2 rounded-md">--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div id="test">--}}
{{--        test--}}
{{--    </div>--}}

{{--    --}}{{--    <div id="range_fields" style="display:none;">--}}
{{--    --}}{{--        <label for="">Range of Dates</label>--}}
{{--    --}}{{--        <input type="date" name="from" class="border border-gray-300 p-2 rounded-md" value="{{ request('from') }}">--}}
{{--    --}}{{--        <input type="date" name="to" class="border border-gray-300 p-2 rounded-md" value="{{ request('to') }}">--}}
{{--    --}}{{--    </div>--}}

{{--    <div id="month_fields" class="" style="width: 10rem; display: none">--}}
{{--        <div class="border border-gray-300 bg-gray-200 px-2 w-full">--}}
{{--            <button id="selectMonth" type="button" class="w-full">January</button>--}}

{{--            <div id="months" style="display: none">--}}
{{--                <ul>--}}
{{--                    <li id="january" onclick="setMonth(this)">January</li>--}}
{{--                    <li id="february" onclick="setMonth(this)">February</li>--}}
{{--                    <li id="march" onclick="setMonth(this)">March</li>--}}
{{--                    <li id="april" onclick="setMonth(this)">April</li>--}}
{{--                    <li id="may" onclick="setMonth(this)">May</li>--}}
{{--                    <li id="june" onclick="setMonth(this)">June</li>--}}
{{--                    <li id="july" onclick="setMonth(this)">July</li>--}}
{{--                    <li id="august" onclick="setMonth(this)">August</li>--}}
{{--                    <li id="september" onclick="setMonth(this)">September</li>--}}
{{--                    <li id="october" onclick="setMonth(this)">October</li>--}}
{{--                    <li id="november" onclick="setMonth(this)">November</li>--}}
{{--                    <li id="december" onclick="setMonth(this)">December</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <input id="month2" type="hidden" name="month" value="January" required>--}}
{{--        <input type="text" name="year" placeholder="Year" class="border border-gray-300 p-2 rounded-md w-full" required>--}}
{{--    </div>--}}

{{--    <br>--}}

{{--    <div>--}}
{{--        <input type="text" name="search" class="border border-gray-300 p-2 rounded-md">--}}
{{--        <button type="submit">Search</button>--}}
{{--    </div>--}}
{{--</form>--}}

<div class="container-scroller">
    <div class="row">
        <div class="col-lg-3">
            @include("admin.navbar")
        </div>
    </div>
    <div class="content-wrapper">
        <div class="w-11/12 mx-auto flex justify-between">
            <div class="flex flex-col items-center">
                <div class="flex space-x-2">
                    <input form="search-filter" type="text" name="search" placeholder="Type here" class="border
                    border-gray-400 p-2
                    rounded-md"
                           style="width:
     20rem">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                    focus:ring-blue-300
        font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700
        focus:outline-none dark:focus:ring-blue-800" form="search-filter">Search</button>
                </div>
            </div>

            <form action="/products/result" method="POST">
                @csrf

                <input type="hidden" name="products" value="{{ collect($products) }}">

                <div>
                    <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800
                    focus:ring-4
        focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600
        dark:hover:bg-green-700 dark:focus:ring-green-800">Print Shown Items</button>
                </div>
            </form>

            <form action="" method="GET" id="search-filter">
            </form>
        </div>

{{--        <div x-data="{ show: false }" class="flex w-11/12 mx-auto">--}}
{{--            <div class="relative">--}}
{{--                <div>--}}
{{--                    <button @click="show = !show" id="selectType" type="button" class="text-white bg-gray-800--}}
{{--                        hover:bg-gray-900--}}
{{--                        focus:outline-none--}}
{{--                    focus:ring-4--}}
{{--                 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800--}}
{{--                 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Exact</button>--}}
{{--                </div>--}}

{{--                <div x-show="show" id="type" style="display:none;" class="border border-gray-300 bg-gray-50--}}
{{--                    absolute rounded mt-2--}}
{{--                    w-full z-20">--}}
{{--                    <ul style="padding-left: 0; margin-bottom: 0">--}}
{{--                        <li id="exact" class="cursor-pointer border-b py-1.5 text-center--}}
{{--                            hover:bg-gray-100">Exact</li>--}}
{{--                        <li id="range" class="cursor-pointer border-b py-1.5 text-center hover:bg-gray-100">Range</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div id="fields">--}}
{{--                <label for="date">Date</label>--}}
{{--                <input type="date" name="date" class="border border-gray-300 p-2 rounded-md" form="search-filter">--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="w-11/12 mx-auto">
            @if($products)
                <div class="relative overflow-x-auto w-full">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kilograms
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Store Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Warehouse Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $product['title'] }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $product['kg'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product['price'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product['store_quantity'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product['warehouse_quantity'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product['description'] }}
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div>
                    <p>There are no products record in the system.</p>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>

<script>

    const type = document.getElementById('type');
    const selectType = document.getElementById('selectType');
    // const selectMonth = document.getElementById('selectMonth');
    const exact = document.getElementById('exact');
    const range = document.getElementById('range');
    // const months = document.getElementById('months');
    const exactFields = document.getElementById('exact_fields');
    const monthFields = document.getElementById('month_fields');
    const rangeFields = document.getElementById('range_fields');
    const month = document.getElementById('month');
    let tests = document.getElementById('test');
    var month2 = document.getElementById('month2');
    const fields = document.getElementById('fields');

    // function setMonth(e) {
    //     let selectedMonth = e.innerText;
    //     selectMonth.innerText = selectedMonth;
    //     months.style.display = 'none';
    //     month2.value = selectedMonth;
    // }

    // selectMonth.addEventListener('click', function () {
    //     if (months.style.display == 'block') {
    //         months.style.display = 'none';
    //     } else {
    //         months.style.display = 'block';
    //     }
    // });

    // selectType.addEventListener('click', function () {
    //     if (type.style.display == 'block') {
    //         type.style.display = 'none';
    //     } else {
    //         type.style.display = 'block';
    //     }
    // });

    exact.addEventListener('click', function () {
        selectType.innerText = 'Exact';
        type.style.display = 'none';
        fields.innerHTML = `<label for="from">Date</label><input type="date" name="date" class="border border-gray-300
        p-2 rounded-md" form="search-filter">`
    });

    range.addEventListener('click', function () {
        selectType.innerText = 'Range';
        type.style.display = 'none';
        fields.innerHTML = `<label for="from">From</label><input type="date" name="from" class="border border-gray-300
        p-2 rounded-md" form="search-filter"><label for="to">To</label><input type="date" class="border border-gray-300
        p-2 rounded-md" name="to" form="search-filter">`;
        console.log(1);
    });

    // month.addEventListener('click', function () {
    //     selectType.innerText = 'Month';
    //     console.log(month.innerText);
    //     type.style.display = 'none';
    //     rangeFields.style.display = 'none';
    //     monthFields.style.display = 'block'
    //     exactFields.style.display = 'none'
    // });


</script>
