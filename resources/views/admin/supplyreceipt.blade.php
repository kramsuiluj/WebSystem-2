<!DOCTYPE html>
<html lang="en">
  <head>

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
				<h1 class=" mt-1 mb-2 h4 mb-0 text-gray-800">Receipt  Management</h1>
				<br>		
				<br>		
				<div class="col-lg-3">
					<button data-toggle="tooltip" id="btnCreate" data-placement="bottom" title="Register " class="btn btn-success mb-4 " data-bs-toggle="modal" data-bs-target="#regReceipt"> <i class="fa fa-plus"></i> Create New Receipt</button>
				</div>
			</div>

		<div class="row ">
			<div class="col-12 grid-margin">
			  <div class="card">
				<div class="card-body">
				  <div >

	  				<div class="col-lg-12 col-sm-12 mb-2" align="center">
	  					<select name="option" id="receipt_type" class="form-design mt-5" style="height:35px; width:250px; border: 0.9px solid DarkSlateGrey; color:Coral; font-weight:500; background-color:PeachPuff;" required>
							<option value="Suppplier" class="text-center" selected >Suppplier ({{$supplierCount}})</option>
							<option value="Customer" class="text-center">Customer ({{$customerCount}})</option>
       					</select>
					</div>


					<form method="post" enctype="multipart/form-data">
					@csrf
						<div class="table-responsive">

								<table id="SupplierTable" class="table table-bordered">
								<thead>
									<tr>
										<th scope="col">Recipient</th>
										<th scope="col">Product Name</th>
										<th scope="col">Quantity</th>
										<th scope="col">Paid Amount</th>
										<th scope="col">Total Fee</th>
										<th scope="col">Date</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($supplierData as $supplierData)
									<tr class="">
										<td>{{$supplierData->recipient}}</td>
										<td data-label="Product">{{$supplierData->prod_name}}</td>
										<td data-label="Quantity">{{$supplierData->prod_qty}}</td>
										<td data-label="Paid Amount">{{$supplierData->paid_fee}}</td>
										<td data-label="Total Fee">{{$supplierData->total_fee}}</td>
										<td data-label="Date">{{$supplierData->date}}</td>
										<td data-label="Date">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#receiptModal" id="btnReceiptMdl" value="{{$supplierData->id}}">
												<i class="fa fa-print"></i>
											</button>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>

						</div>

						<div class="table-responsive">

							<table id="CustomerTable" class="table table-bordered" hidden>
								<thead>
									<tr>
										<th scope="col">Recipient</th>
										<th scope="col">Product Name</th>
										<th scope="col">Quantity</th>
										<th scope="col">Paid Amount</th>
										<th scope="col">Total Fee</th>
										<th scope="col">Date</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($customerData as $customerData)
									<tr class="">
										<td data-label="Product">{{$customerData->recipient}}</td>
										<td data-label="Product">{{$customerData->prod_name}}</td>
										<td data-label="Quantity">{{$customerData->prod_qty}}</td>
										<td data-label="Paid Amount">{{$customerData->paid_fee}}</td>
										<td data-label="Total Fee">{{$customerData->total_fee}}</td>
										<td data-label="Date">{{$customerData->date}}</td>
										<td data-label="Date">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#receiptModal" id="btnReceiptMdl" value="{{$customerData->id}}">
												<i class="fa fa-print"></i>
											</button>
										</td>
									</tr>
									@endforeach

								</tbody>
							</table>

						</div>
						
						
					</form>
						
	
				</div>
				</div>
			</div>


	<div class="modal fade" id="regReceipt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
				<div class="modal-dialog modal-xl modal-md ">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title fst-italic text-white" id="descTittle">Create Receipt</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">                                                  
						<div class="card   mb-3 rounded">
							<div class="card-body"> 
								<div class="container">
									<div class="row gx-4 gx-lg-5  mb-4"> 
									
										<form action ="" autocomplete="off" id="frmAddReceipt">
											<div class="row mb-1 ">                                 
												<div class="col-lg-6 col-md-6 p-1">

													<div class="form-floating mb-1 ">
														<input class="form-control  text-sm-start" name="recipient" id="recipient" type="text" />
														<label for="missionobjective" class="text-muted text-sm-start">Recipient <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text recipient_error"></span>
													</div>

													
													<div class="form-floating mb-1  ">
														<input class="form-control" name="prod_name" id="prod_name" type="text"/>
														<label for="missionobjective" class="text-muted text-sm-start"> Product <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text prod_name_error"></span>
													</div>

													<div class="form-floating mb-1  ">
														<input class="form-control" name="prod_qty" id="prod_qty" type="number" min="1"/>
														<label for="missionobjective" class="text-muted text-sm-start">  Quantity <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text prod_qty_error"></span>
													</div>

													<div class="form-floating mb-1  ">
														<input class="form-control" name="paid_fee" id="paid_fee" type="number"  min="1"/>
														<label for="missionobjective" class="text-muted text-sm-start"> Paid Fee <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text paid_fee_error"></span>
													</div>
																														
												</div> 																	
												
												<div class="col-lg-6 col-md-6 p-1">

													<div class="form-floating mb-1 ">
														<input class="form-control  text-sm-start" name="total_fee" id="total_fee" type="number"  min="1"/>
														<label for="missionobjective" class="text-muted text-sm-start">Total Fee <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text total_fee_error"></span>
													</div>

													
													<div class="form-floating mb-1  ">
														<input class="form-control" name="date" id="date" type="text"  />
														<label for="missionobjective" class="text-muted text-sm-start"> Date (MM/DD/YYYY) <label for="" class="text-danger">*</label></label>
														<span class="text-danger small error-text date_error"></span>
													</div>

													<div class="form-floating mb-1  ">
														{{-- <input class="form-control" type="file" accept="image/*" name="proofImg" id="proofImg" placeholder="Select image to upload"/> --}}
														<input  class="form-control" type="file" accept="image/*" name="proofImg" id="proofImg" placeholder="Select image to upload" required/>
														{{-- <label for="missionobjective" class="text-muted text-sm-start"> Image <label for="" class="text-danger">*</label></label> --}}
														<span class="text-danger small error-text proof_error"></span>
													</div>
													
													<div class="form-floating mb-1  ">
														<label class="text-muted text-sm-start"> Receipt for <label class="text-danger">*</label></label>
														<span class="text-danger small error-text receiptfor_error"></span><br><br>
														<input class="receiptfor" name="receiptfor" id="receiptfor" value="Customer" type="checkbox"/> Customer
                        								<input class="receiptfor" name="receiptfor" id="receiptfor" value="Supplier" type="checkbox"/> Supplier
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
							<button class="btn btn-danger  mt-2" id="addReceipt" type="button"> <i class="fa fa-plus"></i> Save Entries </button>                         
					</div>
					</div>
				</div>
		</div>

	</div>


	{{-- modal for receipt  --}}
	<div class="modal fade" id="receiptModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
	  <div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="staticBackdropLabel">Print Receipt</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<button type="button" class="btn btn-success mb-3" id="btnPrints">
				<i class="fa fa-print" ></i> Print
			</button>
			<div id="printThiss">
				<div class="row">
					
					<div class="col-lg-8 col-md-8 col-sm-6 mb-5 " >
						<img src="{{ asset('/assets/images/rice.png') }}" width="20%" alt="img" id="imageTo">
					</div>
					<div class="col-lg-2 col-md-2 col-sm-3 p-2 mt-5 fw-bold">
						Invoice Number : 
					</div>
					<div class="col-lg-2 col-md-1 col-sm-1 p-2 mt-5 fw-bold" id="invNo">
						
					</div>
					
				</div>
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-3 fw-bold">Customer Name : </div>
					<div class="col-lg-2 col-md-2 col-sm-2">
						<div id="custName"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-3 fw-bold">Order Date : </div>
					<div class="col-lg-2 col-md-2 col-sm-2" id="ordDate"></div>
				</div>
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-3 fw-bold">Invoice Date : </div>
					<div class="col-lg-2 col-md-2 col-sm-2" id="invDate"></div>
				</div>
		
				<div class="row mt-5">
					<div class="col-lg-12 mb-3">
						<div class="table-group-divider"></div>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1"></div>
					<div class="col-lg-2 col-md-2 col-sm-2">Product ID</div>
					<div class="col-lg-2 col-md-2 col-sm-2">Product Name</div>
					<div class="col-lg-2 col-md-2 col-sm-2">Quantity</div>
					<div class="col-lg-2 col-md-2 col-sm-2">Price</div>
					<div class="col-lg-2 col-md-2 col-sm-2">Total</div>
					<div class="col-lg-1 col-md-1 col-sm-2"></div>
					<div class="col-lg-12 mt-3 mb-3">
						<div class="table-group-divider"></div>
					</div>
	
					<div class="col-lg-1 col-md-1 col-sm-1 mb-2"></div>
					<div class="col-lg-2 col-md-2 mb-2 col-sm-2" id="prodId"></div>
					<div class="col-lg-2 col-md-2 mb-2 col-sm-2" id="prodName"></div>
					<div class="col-lg-2 col-md-2 mb-2 col-sm-2" id="quan"></div>
					<div class="col-lg-2 col-md-2 mb-2 col-sm-2" id="amt"></div>
					<div class="col-lg-2 col-md-2 mb-2 col-sm-2" id="total"></div>
					<div class="col-lg-1 col-md-1 mb-2 col-sm-1"></div>
					<div class="col-lg-12 mt-3 table-group-divider"></div>
				</div>
		
				<div class="row mt-5">
					<div class="col-lg-12 fw-bold fs-3 text-center mb-5">PROOF OF TRANSACTION</div>
					<div class="col-lg-3 col-md-3 col-sm-1"></div>
					<div class="col-lg-6 col-md-6 col-sm-10">
						<img src="" alt="test" srcset="" width="80%" id="proof">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-1"></div>
				</div>
			</div>
		  </div>
		   
		</div>
	  </div>
	</div>
	



  	@include("admin.adminscript")
	<script src="{{ asset('js/receiptMgmt.js') }}" defer></script>

	<script>
		// btnReceiptMdl
		$(document).on("click", "#btnReceiptMdl", function (e) {
			var id = $(this).val();
			idKo = id;

			axios.get('/showDetails',{
				params: {
					id: id
					}
			})
			.then(function(response){
				var stat = response.data.status;
				var dataResult = response.data.data;
				var imagee = response.data.image;

				// console.log(data);

				if(stat == 1){
					$(dataResult).each(function(index, item) {
						$("#custName").html(item.recipient);
						$("#invNo").html(item.invoiceNo);
						$("#ordDate").html(item.date);
						$("#invDate").html(item.date);
						$("#prodId").html(item.id);
						$("#prodName").html(item.prod_name);
						$("#quan").html(item.prod_qty);
						$("#amt").html(item.paid_fee);
						$("#total").html(item.total_fee);
						$("#proof").attr("src", imagee );
						console.log(imagee);
						// $("#proof").val(item.);
					});
				}

				
			})
			.catch(function(error) {
				alert(error);
			})
			.then(function(){})

		});
	</script>

<script>
	var checkboxes = $(".check-cls"),
    submitButt = $(".submit-btn");

	checkboxes.click(function() {
    submitButt.attr("disabled", !checkboxes.is(":checked"));
	});

 	$(document).ready(function(){
   // Check or Uncheck All checkboxes
   	$("#checkAll").change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".check-cls").each(function(){
		$(this).prop("checked",true);
		 submitButt.attr("disabled", !checkboxes.is(":checked"));

       });
     }else{
       $(".check-cls").each(function(){
         $(this).prop("checked",false);
		 submitButt.attr("disabled", !checkboxes.is(":checked"));
       });
     }
   });
});
</script>

<script>
	var checkboxes2 = $(".check-cls2"),
    submitButt = $(".submit-btn");

	checkboxes2.click(function() {
    submitButt.attr("disabled", !checkboxes2.is(":checked"));
	});

 	$(document).ready(function(){
   // Check or Uncheck All checkboxes
   	$("#checkAll2").change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".check-cls2").each(function(){
		$(this).prop("checked",true);
		 submitButt.attr("disabled", !checkboxes2.is(":checked"));

       });
     }else{
       $(".check-cls2").each(function(){
         $(this).prop("checked",false);
		 submitButt.attr("disabled", !checkboxes2.is(":checked"));
       });
     }
   });
});
</script>

<script>
  $( function() {
    $( "#date" ).datepicker({
                minDate: 0,
				value: 'hakdog'
            });
  } );
</script>

<script>
    $(document).ready(function(){

		$('#receipt_type').change(function(){
			if($('#receipt_type').val() =='Customer'){
				// $("#printThis").show();
				// $("#printThiss").hide();
				$('#CustomerTable').attr('hidden', false);
				$('#SupplierTable').hide();
				$('.check-cls').prop('checked', false);
				$('#checkAll').prop('checked', false);
				$('.submit-btn').attr("disabled", true);
				document.getElementById('receipt_for').value = 'customer';

			}else{
				// $("#printThis").hide();
				// $("#printThiss").show();
				$('#CustomerTable').attr('hidden', true);
				$('#SupplierTable').show();
				$('.check-cls2').prop('checked', false);
				$('#checkAll2').prop('checked',false);
				$('.submit-btn').attr("disabled", true);
				document.getElementById('receipt_for').value = 'supplier';
			}
		});

		$(document).on("click", "#btnPrint", function (e) {
			var originalContents = document.body.innerHTML;
			$("#btnPrint").hide(); //button
			// $("#imageTo").css("width", "80%");

			var printContents = document.getElementById('printThis').innerHTML;

			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		});

		$(document).on("click", "#btnPrints", function (e) {
			var originalContents = document.body.innerHTML;
			$("#btnPrints").hide(); //button
			// $("#imageTo").css("width", "80%");

			var printContents = document.getElementById('printThiss').innerHTML;

			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		});

		
});
</script>
<script>
$(document).ready(function(){
    $('.receiptfor').click(function() {
        $('.receiptfor').not(this).prop('checked', false);
    });
});
</script>

  </body>
</html>