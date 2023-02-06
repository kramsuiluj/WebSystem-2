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
</head>
<body>

<div class="container-scroller">
    <div class="row">
        <div class="col-lg-3">
            @include("admin.navbar")
        </div>
    </div>
    <div class="content-wrapper">
        <div class="w-11/12 mx-auto flex space-x-2">
            <div class=" mx-auto flex space-x-2">
                <div class="flex flex-col items-center">
                    <div class="flex space-x-2">
                        <input form="search-filter" type="text" name="search" placeholder="Type here" class="border
                    border-gray-400 p-2
                    rounded-md"
                               style="width:
     20rem">

                    </div>
                </div>

                <form action="" method="GET" id="search-filter">
                </form>
            </div>

            <div x-data="{ show: false }" class="flex w-11/12 mx-auto space-x-2 items-center">
                <div class="relative">
                    <div>
                        <button @click="show = !show" id="selectType" type="button" class="text-white bg-gray-800
                        hover:bg-gray-900
                        focus:outline-none
                    focus:ring-4
                 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800
                 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Exact</button>
                    </div>

                    <div x-show="show" id="type" style="display:none;" class="border border-gray-300 bg-gray-50
                    absolute rounded mt-2
                    w-full z-20">
                        <ul style="padding-left: 0; margin-bottom: 0">
                            <li id="exact" class="cursor-pointer border-b py-1.5 text-center
                            hover:bg-gray-100">Exact</li>
                            <li id="range" class="cursor-pointer border-b py-1.5 text-center hover:bg-gray-100">Range</li>
                            <li id="year" class="cursor-pointer border-b py-1.5 text-center hover:bg-gray-100">Yearly</li>
                            <li id="month" class="cursor-pointer border-b py-1.5 text-center hover:bg-gray-100">Monthly</li>
                            <li id="weekly" class="cursor-pointer border-b py-1.5 text-center hover:bg-gray-100">Weekly</li>
                            <li id="daily" class="cursor-pointer border-b py-1.5 text-center hover:bg-gray-100">Daily</li>
                        </ul>
                    </div>
                </div>

                <div id="fields">
                    <label for="date">Date</label>
                    <input type="date" name="date" class="border border-gray-300 p-2 rounded-md" form="search-filter">
                </div>


                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                    focus:ring-blue-300
        font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700
        focus:outline-none dark:focus:ring-blue-800" form="search-filter">Search</button>

                <form action="/sales/result" method="POST">
                    @csrf

                    <input type="hidden" name="sales" value="{{ $sales }}">
                    <input type="hidden" name="range" value="{{ request('from') . '|' . request('to') }}">
                    <input type="hidden" name="date" value="{{ request('date') }}">
                    <input type="hidden" name="year" value="{{ request('year') }}">
                    <input type="hidden" name="monthly" value="{{ request('monthly') }}">
                    <input type="hidden" name="daily" value="{{ request('daily') }}">
                    <input type="hidden" name="weekly" value="{{ request('wYear') . '|' . request('wMonth') }}">

                    <div>
                        <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800
                    focus:ring-4
        focus:ring-green-300 font-medium rounded-lg text-sm px-1 py-1 dark:bg-green-600
        dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>




        <div class="w-11/12 mx-auto">

            <div class="flex justify-end">
                <form action="" method="POST">
                    @csrf

                    <input type="hidden" name="sales" value="{{ $sales }}">
                </form>
            </div>

            @if($sales)
                <div class="relative overflow-x-auto w-4/5">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Invoice #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Reference #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Customer Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Reserved Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kilograms
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product Fee
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Customer Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Customer Phone #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $sale)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $sale->invoiceNo }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $sale->refno }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->products }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->reserved_qty }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->kg }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->product_fee }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->phone }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($sale->date)->toDateString() }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="?delete={{ $sale->id }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div>
                    <p>There are no sales record in the system.</p>
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
    const year = document.getElementById('year');
    const weekly = document.getElementById('weekly');
    const daily = document.getElementById('daily');
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
    });

    year.addEventListener('click', function () {
        selectType.innerText = 'Year';
        type.style.display = 'none';
        fields.innerHTML = `<input class="border border-gray-300
        p-2 rounded-md" type="number" min="1900" max="2099" step="1" value="2016" name="year" form="search-filter"/>`;
    });

    month.addEventListener('click', function () {
        selectType.innerText = 'Monthly';
        type.style.display = 'none';
        fields.innerHTML = `<input class="border border-gray-300
        p-2 rounded-md" type="number" min="1900" max="2099" step="1" value="2016" name="monthly"
        form="search-filter"/>`;
    });

    weekly.addEventListener('click', function () {
        selectType.innerText = 'Weekly';
        type.style.display = 'none';
        fields.innerHTML = `<input class="border border-gray-300
        p-2 rounded-md" type="number" min="1900" max="2099" step="1" value="2016" name="wYear"
        form="search-filter"/><input class="border border-gray-300
        p-2 rounded-md" type="number" min="1" max="12" step="1" value="1" name="wMonth"
        form="search-filter"/>`;
    });

    daily.addEventListener('click', function () {
        selectType.innerText = 'Daily';
        type.style.display = 'none';
        fields.innerHTML = `<label for="from">Date</label><input type="date" name="daily" class="border border-gray-300
        p-2 rounded-md" form="search-filter">`
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
