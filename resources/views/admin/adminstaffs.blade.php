<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

	

    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

	



  </head>
  <body>
	
	<div class="container-scroller">
		<div class="row">
			<div class="col-lg-3">
				@include("admin.navbar")
			</div>
	</div>

	<!-- <div class="main-panel"> -->
	<div class="content-wrapper">
	@if(auth()->user()->access_level == 2)
		<div class="row">
			<h1 class=" mt-1 mb-2 h4 mb-0 text-gray-800">Staff  Management</h1>
			<br>		
			<br>		
			<div class="col-lg-3">
				<button data-toggle="tooltip" id="btnCreate" data-placement="bottom" title="Register " class="btn btn-success mb-4 " data-bs-toggle="modal" data-bs-target="#regStaff"> <i class="fa fa-plus"></i> Add Staff Details </button>
			</div>
		</div>
	@endif

		
			<div class="row ">
				<div class="col-12 grid-margin">
					<div class="card">
						<div class="card-body">
						<!-- <h4 class="card-title">Product Management</h4> -->
							<table class="table table-bordered ">
								<thead> 
								<tr>
									<th class="text-light" scope="col" >Staff Name</th>
									<th  class="text-light" scope="col">Contact</th>
									<th class="text-light" scope="col" >Image</th>
									@if(auth()->user()->access_level == 2)
									<th  class="text-light" scope="col">Action</th>
									@endif
								</tr>
								</thead>
                @foreach($data as $data)
                    
                    <tr align="center">
                      <td data-label="Staff Name">{{$data->name}}</td>
                      <td data-label="Contact">{{$data->speciality}}</td>
                      <td><img height="100" width="100" src="/staffsimage/{{$data->image}}"></td>
                      @php $encryption_id = Crypt::encrypt($data->id);@endphp
                      @if(auth()->user()->access_level == 2)
					  	<td > 
							<button data-toggle='tooltip' data-placement='bottom' value="{{($data->id)}}" id='updateStaff'  title='Update Product details' data-bs-toggle='modal' data-bs-target='#regStaff' type='button' class='btn btn-primary '> <i class='fa fa-pencil-alt'></i>  </button>
							<a class="btn btn-danger" href="{{url('/deletestaff',$data->id)}}" > <i class='fa fa-ban'></i> </a>
						</td>
                      @else

                      @endif
                    </tr>
              
                    @endforeach
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="regStaff" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
				<div class="modal-dialog modal-md modal-md ">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title fst-italic text-dark" id="descTittle">Staff Registration </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">                                                  
						<div class="card   mb-3 rounded">
							<div class="card-body"> 
								<div class="container">
									<div class="row gx-4 gx-lg-5  mb-4"> 

										<form action ="" autocomplete="off" id="frmAddStaff">
											<div class="row mb-1 ">                                 
										 																	
												
												<div class="col-lg-12 col-md-12 p-1">

													<div class="form-floating mb-1 ">
														<input class="form-control  text-sm-start" name="name" id="name" type="text"  />
														<label for="missionobjective" class="text-muted text-sm-start">Name <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text name_error"></span>
													</div>

													
													<div class="form-floating mb-1  ">
														<input class="form-control" name="contact" id="contact" type="text"  />
														<label for="missionobjective" class="text-muted text-sm-start"> Contact <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text contact_error"></span>
													</div>

													<div class="form-floating mb-1  ">
														<input class="form-control" name="image" id="image" type="file" />
														<label for="missionobjective" class="text-muted text-sm-start"> Image <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text image_error"></span>

														
													</div>
																														
												</div> 		
											</div>                               
										</form>                                        
									</div> 
								</div>                                      
							</div>
						</div>
	
					</div>
					<div class="modal-footer">
							<button class="btn btn-danger  mt-2" id="addProduct" type="button"> <i class="fa fa-plus"></i> Save Entries </button>                         
					</div>
					</div>
				</div>
		</div>


	</div>

  	@include("admin.adminscript")
   <script src="{{ asset('js/staffMgmt.js') }}" defer></script>
</div>

  </body>
</html>
