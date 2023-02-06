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

    <style>
        body{
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
        }
        table{
            padding: 3px;
        }
    </style>

    <!-- fa  -->

</head>
<body>


<div class="">
    <div class="row">



        <div class="col-lg-12 text-center mt-5 mb-1">
            <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets/images/rice.png')))}}">
        </div>
        <div class="col-lg-12 text-center m-3">
				<h5> Product Report for remaining stocks</h5>
			</div>


        <div class="table-responsive">
            <table class="table p-3">
                <thead class="table-group-divider p-3">
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Kilograms</th>
                    <th scope="col">Store Quantity</th>
                    <th scope="col">Warehouse Quantity</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($data as $data)
                    <tr class="">
                        <td>{{$data['title']}}</td>
                        <td>{{$data['kg']}} KG</td>
                        <td>{{$data['store_quantity']}}</td>
                        <td>{{$data['warehouse_quantity']}}</td>
                    </tr>
                @endforeach
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

</body>
</html>
