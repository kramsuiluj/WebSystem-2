<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
    @include("admin.admincss")
	<link href="{{ asset('css/apps.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"> -->
	<script src="{{ asset('js/sweetalert2.js') }}" ></script>

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
			<h1 class="mt-1 mb-2 h4 mb-0 text-gray-800">Users Management</h1>
			<br>		
			<br>	
		</div>
		<div class="row ">
			<div class="col-12 grid-margin">
			  <div class="card">
				<div class="card-body">
				  <div >
					<table class="table table-bordered" >
						<thead> 
						<tr>
							<th class="text-light">Name</th>
							<th class="text-light">Email</th>
							<th class="text-light">User Type</th>
							<th class="text-light">Manage</th>
						</tr>
						</thead> 
						<tbody>
			
							@foreach($data as $data)
								@include('admin.usersmodal')
								<tr align="center">
									<td data-label="Name">{{$data->name}}</td>
									<td data-label="Email">{{$data->email}}</td>
									@if($data->usertype > "0")
									<td data-label="User Type">Admin</td>
									@else
									<td data-label="User Type">Customer</td>
									@endif
				
									@if($data->access_level < 2)
									@if(auth()->user()->access_level < 2)
									<td><a>Restricted</a></td>
									@else
									<td>
									<button class="btn btn-success" data-toggle="modal" data-target="#usersModal{{$data->id}}">MANAGE</button>
									</td>
									@endif
									@else
									<td><a>Restricted</a></td>
									@endif
				
								</tr>
							@endforeach
			

							</tbody>
						</table>
					</div>
		</div>	
  	@include("admin.adminscript")

  </body>
</html>

</body>
</html>

