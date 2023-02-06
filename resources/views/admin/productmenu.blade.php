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
		<div class="row">
			<h1 class=" mt-1 mb-2 h4 mb-0 text-gray-800">Product Management</h1>
			<br>		
			<br>		
			<div class="col-lg-3">
				<button data-toggle="tooltip" id="btnCreate" data-placement="bottom" title="Register " class="btn btn-success mb-4 " data-bs-toggle="modal" data-bs-target="#regProduct"> <i class="fa fa-plus"></i> Add Product </button>
			</div>
		</div>

			<div class="row ">
				<div class="col-12 grid-margin">
					<div class="card">
						<div class="card-body">
						<!-- <h4 class="card-title">Product Management</h4> -->
							<table class="table table-bordered">
								<thead> 
								<tr>
									<th class="text-light" >Product Name</th>
									<th  class="text-light" >Price</th>
									<th class="text-light" >Available Quantity</th>
									<th  class="text-light" >Description</th>
									<!-- <th style="padding: 30px">singit</th> -->
									<th  class="text-light" >Image</th>
									<th  class="text-light" >Action</th>
								</tr>
								</thead>

								@foreach($data as $data)

								<tr align="center">
									<td data-label="Product Name">{{$data->title}}</td>
									<td data-label="Price">
									<?php 
									$kilos = explode('.',$data->kg);
									$price = explode('.',$data->price);
									for($i=0;$i<count($price);$i++) {
									echo '<br/><br/>'.$price[$i].' per '.$kilos[$i].'kg';
									}
									?>	
									</td>
									<td data-label="Avail Qty">

									<?php 
									echo '<u>Stacks in store:</u> ';
									$kilos = explode('.',$data->kg);
									
									$store_quantity = explode('.',$data->store_quantity);
									for($i=0;$i<count($store_quantity);$i++) {
									echo '<br/>'.$store_quantity[$i].' sacks of '.$kilos[$i].'kg';
									}
									echo '<br><br><u>Stacks in warehouse:</u>  ';
									$kilos = explode('.',$data->kg);
									$warehouse_quantity = explode('.',$data->warehouse_quantity);
									for($i=0;$i<count($warehouse_quantity);$i++) {
									echo '<br/>'.$warehouse_quantity[$i].' sacks of '.$kilos[$i].'kg';
									}
									?>

									</td>

									<td data-label="Description">{{$data->description}}</td>
									<!-- <td>
										<?php
										$array1 = array("$data->title");
										foreach($array1 as $loopdata){
											echo "$loopdata<br>"; 
										}
										?>
									</td> -->
									<td ><img height="200" width="200" src="productimage/{{$data->image}}"></td>
									@php $encryption_id = Crypt::encrypt($data->id);@endphp
									@if(auth()->user()->access_level < "1")
									<td>
									RESTRICTED
									<!-- <a href="{{url('/deletemenu',$data->id)}}" style="pointer-events: none;" >DELETE</a> -->
									</td>
									<td>
									RESTRICTED
									<!-- <a href="{{url('/updateview',$encryption_id)}}" style="pointer-events: none;" >UPDATE</a> -->
									</td>
									@else
									<!-- <td ><a class="btn btn-danger" href="{{url('/deletemenu',$data->id)}}" >DELETE</a></td> -->
									<td > <button data-toggle='tooltip' data-placement='bottom' value="{{($data->id)}}" id='updateProducts'  title='Update Product details' data-bs-toggle='modal' data-bs-target='#regProduct' type='button' class='btn btn-primary '> <i class='fa fa-pencil-alt'></i>  </button>
									<!-- <button data-toggle='tooltip'  value= '" + item.ids + "' id='remove'  title='Remove Product '   type='button' class='btn btn-danger '> <i class='fa fa-ban'></i>   -->
									<a class="btn btn-danger" href="{{url('/deletemenu',$data->id)}}" > <i class='fa fa-ban'></i> </a>
								</td>
								
									@endif
								</tr>
								@include('admin.adminmodal')
								@endforeach
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="regProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
				<div class="modal-dialog modal-xl modal-md ">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title fst-italic text-white" id="descTittle">Product Registration </h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">                                                  
						<div class="card   mb-3 rounded">
							<div class="card-body"> 
								<div class="container">
									<div class="row gx-4 gx-lg-5  mb-4"> 

								
										<p class="text-sm-start fst-bold ">NOTE:</p>
											<p class="text-sm-start "> For <u>single value</u>, you can input data normally. e.g. Price 100, Store(stocks) 12, Warehouse(stocks) 6, Kilo(s) 15<br>
											For <u>multiple value</u>, you can input multiple data and separate them using dot(.).<br>e.g. Price 100.200.300, Kilo(s) 15.20.25, Store(stocks) 12.23.34, Warehouse(stocks) 45.56.67<br>
											<br>OUTPUT:<br>
											100 pesos per 15kg, with 12 stocks in Store and 45 in Warehouse<br>
											200 pesos per 20kg, with 23 stocks in Store and 56 in Warehouse<br>
											300 pesos per 25kg, with 34 stocks in Store and 67 in Warehouse
											</p>
									
										<form action ="" autocomplete="off" id="frmAddProduct">
											<div class="row mb-1 ">                                 
												<div class="col-lg-6 col-md-6 p-1">

													<div class="form-floating mb-1 ">
														<input class="form-control  text-sm-start" name="product" id="product" type="text" placeholder="Last Name" />
														<label for="missionobjective" class="text-muted text-sm-start">Name <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text umember_lname_error"></span>
													</div>

													
													<div class="form-floating mb-1  ">
														<input class="form-control" name="description" id="description" type="text"/>
														<label for="missionobjective" class="text-muted text-sm-start"> Description <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text description_error"></span>
													</div>

													<div class="form-floating mb-1  ">
														<input class="form-control" name="price" id="price" type="text" />
														<label for="missionobjective" class="text-muted text-sm-start">  Price <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text price_error"></span>
													</div>

													<div class="form-floating mb-1  ">
														<input class="form-control" name="kilos" id="kilos" type="text"  />
														<label for="missionobjective" class="text-muted text-sm-start"> Kilos <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text kilos_error"></span>
													</div>
																														
												</div> 																	
												
												<div class="col-lg-6 col-md-6 p-1">

													<div class="form-floating mb-1 ">
														<input class="form-control  text-sm-start" name="store" id="store" type="text"  />
														<label for="missionobjective" class="text-muted text-sm-start">Store <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text store_error"></span>
													</div>

													
													<div class="form-floating mb-1  ">
														<input class="form-control" name="warehouse" id="warehouse" type="text"  />
														<label for="missionobjective" class="text-muted text-sm-start"> Warehouse <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text warehouse_error"></span>
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

		<!-- update product -->
		<div class="modal fade" id="updateProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
				<div class="modal-dialog modal-xl modal-md ">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title fst-italic text-white" id="staticBackdropLabel">Product update</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">                                                  
							<div class="card shadow-sm  mb-3 rounded">
								<div class="card-body"> 
									<div class="container">
										<div class="row gx-4 gx-lg-5 mt-1 mb-4"> 
											<label for="missionTitle" class="fs-6 fst-italic text-danger">*Enroll Product*</label>
											<form action ="" autocomplete="off" id="frmAddProduct">
												<div class="row mb-1 ">                                 
																															
													
												</div>                               
											</form>                                        
										</div> 
									</div>                                      
								</div>
							</div>
		
						</div>
						<div class="modal-footer">
								<button class="btn btn-danger  mt-2" id="adddependent" type="button"> <i class="fa fa-plus"></i> Save Entries </button>                         
						</div>
					</div>
				</div>
		</div>
	</div>

  	@include("admin.adminscript")
   <script src="{{ asset('js/productMgmt.js') }}" defer></script>
</div>

  </body>
</html>



