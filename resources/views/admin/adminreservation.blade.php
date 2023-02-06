<!DOCTYPE html>
<html lang="en">
  <head>
    
    @include("admin.admincss")
	<link href="{{ asset('css/apps.css') }}" rel="stylesheet">
	
  </head>
  <body>

    <div class="container-scroller">
		<div class="row">
			<div class="col-lg-3">
				@include("admin.navbar")
			</div>
	   </div>
			<div class="content-wrapper">
			@if(auth()->user()->access_level == 2)
				<div class="row">
					<h1 class="mt-1 mb-2 h4 mb-0 text-gray-800">Reservation Management</h1>
					<br>		
					<br>	
					<div class="col-lg-3">
						<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#changeQR"> CHANGE QR</button>
					</div>
				</div>
			@endif

			<div class="row ">
				<div class="col-12 grid-margin">
				  <div class="card">
					<div class="card-body">
						
						<table class="table table-striped">
								  <tr>
									<select name="option" id="history_type" class="form-design mt-5" style="height:35px; width:250px; border: 0.9px solid DarkSlateGrey; color:#198754; font-weight:500; background-color:PeachPuff;" required>
										<option value="Pending" class="text-center" selected >Pending Reservations ({{$countPending}})</option>
										<option value="Approved" class="text-center">Approved Reservations ({{$countApproved}})</option>
										<option value="History" class="text-center">History ({{$countHistory}})</option>
									</select>
								  
									  <h3 class="pending-text mt-1 mb-2 h4 mb-0 text-gray-800" align="center">PENDING RESERVATIONS</h3>
											<table class="table table-hover" id="pendingTable">
												<thead>
												<tr>
												  <th class="text-light" scope="col" >Reservations</th>
													<th class="text-light" scope="col" >Email</th>
													<th class="text-light" scope="col" >Username</th>
													<th class="text-light" scope="col" >Address</th>
													<th class="text-light" scope="col" >Contact No.</th>
													<th class="text-light" scope="col" >Ref No.</th>
												  <th class="text-light" scope="col" >Fee</th>
												  <th class="text-light"></th>
												</tr>
											</thead>
											@forelse($data as $data)
											  @php $encryption_id = Crypt::encrypt($data->user_id);@endphp
											  <form action="{{url('/pending',$encryption_id)}}" method="post" enctype="multipart/form-data" >
											  @csrf	
												<tr align="center">
												  <td data-label="Reservations">{{$data->reserved_qty}}</td>
												  <td data-label="Email">{{$data->email}}</td>
													<td data-label="Username">{{$data->name}}</td>
													<td data-label="Address">{{$data->address}}</td>
													<td data-label="Contact No.">{{$data->phone}}</td>
												  @if($data->refno != null)
													<td data-label="Ref No.">{{$data->refno}}</td>
												  @else
												  <td>N/A</td>
												  @endif
												  <td data-label="Fee">{{$data->product_fee}}</td>
												  <!-- <td>{{$data->buy_option}}</td> -->
												  <input type="hidden" name="reserved_qty" value="{{$data->reserved_qty}}">
												  <input type="hidden" name="prod_id" value="{{$data->prod_id}}">
												  <input type="hidden" name="reserved_id" value="{{$data->id}}">
												  @php $encryption_id = Crypt::encrypt($data->user_id);@endphp
												  @if(auth()->user()->access_level == 2)
												  <td>
												  <button name="submit" type="submit" id="form-submit"  class="submit-btn"  >Manage</button>
												  </td>
												  @else
												  @endif
												</tr>
										  </form>
									  @empty
										  <tr align="center">
								  				<tbody>
												  <td>N/A</td>
												  <td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
												  <td>N/A</td>
												  <td>N/A</td>
												</tr>
											</tbody>
												@endforelse
											</table>
									  <h3 class="approved-text text-center mt-1 mb-2 h4 mb-0 text-gray-800" hidden>APPROVED WALK IN RESERVATIONS</h3>
											<table class="table table-bordered" id="approvedTable" hidden>
												<thead>
												<tr>
												  <th class="text-light" scope="col" >Reservations</th>
													<th class="text-light" scope="col" >Username</th>
													<th class="text-light" scope="col" >Address</th>
													<th class="text-light" scope="col" >Contact No.</th>
													<th class="text-light" scope="col" >Ref No.</th>
												  <th class="text-light" scope="col" >Fee</th>
												  <th class="text-light"></th>
												</tr>
											</thead>
									  @forelse($walkin_data as $walkin_data)
									  @php $encryption_id = Crypt::encrypt($walkin_data->user_id);@endphp
									  <form action="{{url('/viewApproved',$encryption_id)}}" method="post" enctype="multipart/form-data" >
										  @csrf	
										  <tbody>
											<tr align="center">
												  <td data-label="Reservations">{{$walkin_data->reserved_qty}}
												  <input type="hidden" name="buy_option" value="{{$walkin_data->buy_option}}">
												  </td>
													<td data-label="Username">{{$walkin_data->name}}</td>
													<td data-label="Address">{{$walkin_data->address}}</td>
													<td data-label="Contact No.">{{$walkin_data->phone}}</td>
												  <td data-label="Ref No.">{{$walkin_data->refno}}</td>
												  <td data-label="Fee">{{$walkin_data->product_fee}}</td>
												  <td><button name="submit" type="submit" id="form-submit"  class="submit-btn" >Manage</button></td>
												</tr>
											</tbody>
									  </form>
										  @empty
										  <tbody>
										  <tr align="center">											
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
												  <td>N/A</td>
												  <td>N/A</td>
												</tr>
											</tbody>
											
									  @endforelse
								  
									  </table>
									  <h3 class="approved-text text-center mt-1 mb-2 h4 mb-0 text-gray-800" hidden>APPROVED DELIVERY IN RESERVATIONS</h3>
											<table class="table table-bordered" id="approvedTable2"hidden>
												<thead>
												<tr>
												  <th class="text-light" scope="col" >Reservations</th>
													<th class="text-light" scope="col" >Username</th>
													<th class="text-light" scope="col" >Address</th>
													<th class="text-light" scope="col" >Contact No.</th>
													<th class="text-light" scope="col" >Ref No.</th>
												  <th class="text-light" scope="col" >Fee</th>
												  <th class="text-light"></th>
												</tr>
											</thead>
									  @forelse($deliver_data as $deliver_data)
									  @php $encryption_id = Crypt::encrypt($deliver_data->user_id);@endphp
									  <form action="{{url('/viewApproved',$encryption_id)}}" method="post" enctype="multipart/form-data" >
										  @csrf	
											<tr align="center">
												  <td data-label="Reservations">{{$deliver_data->reserved_qty}}
												  <input type="hidden" name="buy_option" value="{{$deliver_data->buy_option}}">
												  </td>
													<td data-label="Username">{{$deliver_data->name}}</td>
													<td data-label="Address">{{$deliver_data->address}}</td>
													<td data-label="Contact No.">{{$deliver_data->phone}}</td>
												  <td data-label="Ref No.">{{$deliver_data->refno}}</td>
												  <td data-label="Fee">{{$deliver_data->product_fee}}</td>
												  <td><button name="submit" type="submit" id="form-submit"  class="submit-btn">Manage</button></td>
								  
												</tr>
									  </form>
										  @empty
										  <tr align="center">
											
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
												  <td>N/A</td>
												  <td>N/A</td>
												</tr>
											
									  @endforelse
									  </table>
									  <div class="table-container">
									  <h3 class="history-text text-center mt-1 mb-2 h4 mb-0 text-gray-800" hidden>RESERVATIONS HISTORY</h3>
											<table class="table  table-bordered" id="historyTable"hidden>
												<thead>
												<tr>
												  <th class="text-light" scope="col" >Reservations</th>
													<th class="text-light" scope="col" >Username</th>
													<th class="text-light" scope="col" >Address</th>
													<th class="text-light" scope="col" >Contact No.</th>
													<th class="text-light" scope="col" >Ref No.</th>
												  <th class="text-light" scope="col" >Fee</th>
												  <th class="text-light" scope="col" >Date</th>
												</tr>
											</thead>
									  @forelse($history as $history)	
											<tr align="center">
												  <td data-label="Reservations">{{$history->reserved_qty}} {{$history->kg}}kg of {{$history->products}}
												  </td>
													<td data-label="Username">{{$history->name}}</td>
													<td data-label="Address">{{$history->address}}</td>
													<td data-label="Contact No.">{{$history->phone}}</td>
												  <td data-label="Ref No.">{{$history->refno}}</td>
												  <td data-label="Fee">{{$history->product_fee}}</td>
												  <td data-label="Date">{{$history->history_date}} at {{$history->time}}</td>
												</tr>
										  @empty
										  <tr align="center">
											
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
													<td>N/A</td>
												  	<td>N/A</td>
												</tr>
											
									  @endforelse
									  </table>
								  </div>
									</div>
									</div>
							</tr>
						  </thead>
							  </td>
							</tr>
						  </tbody>
						</table>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
  


		<!-- Modal -->                   
		<div class="modal fade" id="changeQR" tabindex="-1" role="dialog" aria-labelledby="changeQRlbl" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content bg-white">
			<div class="modal-header" style="background:#fd7e14;">
			<h5 class="modal-title fst-italic text-white" id="staticBackdropLabel">QR Management</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
				
				<div class="col-lg-12">
					<div class="contact-form">
					<form id="contact" action="{{url('/set_qr',$user->id)}}" method="post" enctype="multipart/form-data">
						@csrf
							<div class="row">
								
								<div class="col-lg-12">
									<div align=center>
									@if($user->qr == null)
									<img style="margin:5px; height:200px; width:200px;" src="qr_imgs/qr_sample.jpg" >
									@else
									<img style="margin:5px; height:200px; border:1px solid black; width:200px;" src="/qr_imgs/{{$user->qr}}">
									@endif
									</div>
									
								</div>

								<div class="col-lg-12">
								<div align=center>
									<label style="color:black;">Insert Image
										<input style="color: white; margin:1%;" type="file" name="image">
									</label>
									<br>
									<input style="margin-top:1px; width:250px;" name="phone" placeholder="Enter Contact Number" value="{{$user->phone}}" ><br>
								</div>
								</div>

								<div class=" col-lg-12 mb-2 mt-5 text-center">
										<button name="submit" type="submit" id="form-submit" class="btn btn-success m-2" >SUBMIT</button>
								</div>
							</div>
					</form>
					</div>
				</div>

			</div>
		</div>
		</div>
		<!-- End Modal -->



  	@include("admin.adminscript")
	  <script>
     $(document).ready(function(){
    $('#history_type').change(function(){
        if($('#history_type').val() =='Approved'){
            $('#approvedTable').attr('hidden', false);
            $('#approvedTable2').attr('hidden', false);
            $('.approved-text').attr('hidden', false);
			$('.walk_btn').attr('hidden', false);
			$('.deliv_btn').attr('hidden', false);
			$('.history-text').attr('hidden', true);
            $('#historyTable').attr('hidden', true);
            $('.pending-text').hide();
            $('#pendingTable').hide();
        }else if($('#history_type').val() =='History'){
            $('#approvedTable').attr('hidden', true);
            $('#approvedTable2').attr('hidden', true);
            $('.approved-text').attr('hidden', true);
			$('.walk_btn').attr('hidden', true);
			$('.deliv_btn').attr('hidden', true);
			$('.history-text').attr('hidden', false);
            $('#historyTable').attr('hidden', false);
            $('.pending-text').hide();
            $('#pendingTable').hide();
        }else{
            $('#approvedTable').attr('hidden', true);
            $('#approvedTable2').attr('hidden', true);
            $('.approved-text').attr('hidden', true);
			$('.walk_btn').attr('hidden', true);
			$('.deliv_btn').attr('hidden', true);
			$('.history-text').attr('hidden', true);
            $('#historyTable').attr('hidden', true);
            $('.pending-text').show();
            $('#pendingTable').show();
        }
    })
});</script>
  </body>
</html>