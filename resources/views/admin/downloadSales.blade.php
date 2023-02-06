<!DOCTYPE html>
<html lang="en">

  <head>

	<!-- bs5  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <!-- swal  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- axios  -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{--      <script src="https://cdn.tailwindcss.com"></script>--}}

	<style>
		body{
			font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
		}
		table{
			padding: 3px;
		}
        #print-container {
            position: absolute;
            justify-content: end;
            left: 45rem;
            top: 4.5rem;
        }

        #print {
            text-decoration: none;
            background: green;
            color: white;
            border: none;
            padding: 5px 10px;
            font: inherit;
            cursor: pointer;
            outline: inherit;
            border-radius: 10px;
        }

        @media print
        {
            #print-container, #print
            {
                display: none !important;
            }
        }
	</style>

    <!-- fa  -->

  </head>
  <body>

	<div class="">
		<div class="row">

            <div id="print-container">
                <button id="print">Print</button>
            </div>



			<div class="col-lg-12 text-center mt-5 mb-1">
				<img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets/images/rice.png')))}}">
			</div>
			<div class="col-lg-12 text-center m-3">
{{--                {{ empty($selectedDates) || $selectedDates == '' ? 'all time' : $selectedDates }}--}}
				<h5> Sales Report for {{ $selectedDates }}
{{--					@php--}}
{{--					$arr = [];--}}
{{--						foreach($data as $year){--}}
{{--							$arr[] = \Carbon\Carbon::parse($year['date'])->year;--}}
{{--						}--}}
{{--						$unique_data = array_unique($arr);--}}
{{--						foreach($unique_data as $val) {--}}
{{--							echo $val." ";--}}
{{--						}--}}
{{--					@endphp--}}
				</h5>
			</div>



			<div class="table-responsive">
				<table class="table p-3">
					<thead class="table-group-divider p-3">
						<tr>
							<th scope="col">Month</th>
							<th scope="col">Product</th>
							<th scope="col">Total KG Sold</th>
							<th scope="col">Total Quantity Sold</th>
							<th scope="col">Revenue</th>
						</tr>
					</thead>
					<tbody class="table-group-divider">
						@php
							$total=0;
						@endphp
						@foreach($data as $data)
							<tr class="">
								<td scope="row">{{ \Carbon\Carbon::parse($data['date'])->monthName . ', ' .
								\Carbon\Carbon::parse($data['date'])->year }}</td>
								<td>{{$data['products']}}</td>
								<td>{{$data['kg']}} KG</td>
								<td>{{$data['reserved_qty']}}</td>
								<td>{{$data['product_fee']}}</td>
							</tr>
							@php
								$total+=$data['product_fee'];
							@endphp
						@endforeach
						<tr class="">
								<td scope="row"></td>
								<td></td>
								<td></td>
								<td>TOTAL:</td>
								<td>{{$total}}</td>
							</tr>

					</tbody>
				</table>
			</div>

		</div>
	</div>

    <div style="display: flex; justify-content: flex-end;">
        <p style="border-top: 2px solid black; margin-right: 5rem; padding: 0 3rem; margin-top: 5rem">
            Name and Signature
        </p>
    </div>

    <script>
        const printBtn = document.getElementById('print');
        const printContainer = document.getElementById('print-container')

        printBtn.addEventListener('click', () => {
            window.print();
        });
    </script>
  </body>

</html>
