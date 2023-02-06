
<!DOCTYPE html>
<html lang="en">
  <head>
  	<base href="/public">
    
    @include("admin.admincss")
    <style>
	@media(max-width:645px){
		#labelId{
		margin-top:7%;
		}
	}
	</style>
  </head>
  <body>
    
    <div class="container-scroller">
  	@include("admin.navbar")

  	  	<div style="position: relative; margin-top: 7%; right: -0px;">
			<label id="labelId" style="font-size: 25px;">SOLD FROM WALK IN CUSTOMERS</label>
		<div class="col-lg-12">
		
      	<form action="{{url('/sold_from_walkin',$data->id)}}" method="post" enctype="multipart/form-data">
          @csrf
		   
		<select name="options" id="option_type" class="form-design " style="height:40px; width:350px; border: 1px solid black; color:white; margin:2px; font-weight:bold; background-color:grey;" required>
            <option value="" class="text-center" selected disabled>Sold Product(s) From...</option>
			@if($data->store_quantity == null)
			<option value="store" class="text-center" disabled>(0) can be Sell from Store</option>
			@else
			<?php 
				$total = 0;
    			$store = explode('.',$data->store_quantity);
   				for($i=0;$i<count($store);$i++) {
					$total += $store[$i];
    			}
			?>
			<option value="store" class="text-center">(<?=$total;?>) can be Sell from Store</option>
			@endif
			@if($data->warehouse_quantity == null)
			<option value="warehouse" class="text-center" disabled>(0) can be Sell from Warehouse</option>
			@else
			<?php 
				$total = 0;
    			$warehouse = explode('.',$data->warehouse_quantity);
   				for($i=0;$i<count($warehouse);$i++) {
						$total += $warehouse[$i];
    			}
			?>
			<option value="warehouse" class="text-center">(<?=$total;?>) can be Sell from Warehouse</option>
			@endif
        </select>

		<div>
		<div class="row">

			<div class="col-sm-2">
				<label>Kilos</label>
  				<input style="color: black; width:175px;" name="kg" id="kg" pattern="[0-9.]+" title="Numbers only and must be separated by (.) e.g. 1.2.3" placeholder="Enter kilo(kg)"  disabled required>
  			</div>

			<div class="col-sm-2">
			<label>Enter Quantity</label>
  			<input  style="color: black; width:150px; margin:2px;" name="entered_qty" id="sold_qty" pattern="[0-9.]+" title="Numbers only and must be separated by (.) e.g. 1.2.3" placeholder="Enter Quantity" min="1" disabled required>
			</div>

			<div class="col-sm-2">
			<label>Paid Amount</label>
  			<input  style="color: black; width:150px; margin:2px;" id="paid" name="paid" pattern="[0-9.]+" title="Numbers only and must be separated by (.) e.g. 1.2.3" placeholder="Enter Here" disabled required>
			</div>
			
		</div>
		<input type="submit" value="PROCEED" class="btn btn-success btn-m" id="sold_btn" disabled>

		</form>
      	</div>
		</div>
		
		<label id="labelId" style="font-size: 25px;">UPDATE PRODUCT DETAILS HERE</label>
		<div class="col-lg-10 bg-secondary">
		<label id="labelId" style="font-size: 15px;">Current Details</label>
			<div class="row">
			<div class="col-sm-1">
  				<label><u>Product</u></label><br>
  				<label>{{$data->title}}</label>
  			</div>
  			<div class="col-sm-2">
  				<label><u>Description</u></label><br>
  				<label>{{$data->description}} </label>
  			</div>
  			<div class="col-sm-2">
  				<label><u>Prices per kg</u></label><br>
  				<label>
				  <?php 
    				$kilos = explode('.',$data->kg);
    				$price = explode('.',$data->price);
   					for($i=0;$i<count($price);$i++) {
    				echo $price[$i].' per '.$kilos[$i].'kg<br>';
    				}
					?>
				</label>
  			</div>

  			<div class="col-sm-3">
  				<label>Stocks in Store</label><br>
  				<label><?php 
				$kilos = explode('.',$data->kg);
				$store = explode('.',$data->store_quantity);
				   for($i=0;$i<count($store);$i++) {
				echo $store[$i].' sacks of '.$kilos[$i].'kg<br>';
				}
				?></label>
  			</div>

			  <div class="col-sm-3">
  				<label>Stocks in Warehouse</label><br>
  				<label><?php 
				$kilos = explode('.',$data->kg);
				$warehouse = explode('.',$data->warehouse_quantity);
				   for($i=0;$i<count($warehouse);$i++) {
				echo $warehouse[$i].' sacks of '.$kilos[$i].'kg<br>';
				}
				?></label>
  			</div>

			</div>
		</div>
  		<form action="{{url('/update',$data->id)}}" method="post" enctype="multipart/form-data" >
  			@csrf
		<div class="row " >	
  			<div class="col-sm-2">
  				<label>Product</label>
  				<input style="color: black; width:175px;" type="text" name="title" value="{{$data->title}}" required>
  			</div>
  			<div class="col-sm-2">
  				<label>Description</label>
  				<input style="color: black; width:175px;" type="text" name="description" value="{{$data->description}}" required>
  			</div>
		</div>
		<div class="row">
		<div class="col-sm-2 mt-1">	
				<label>Price</label>
  				<input style="color: black; width:175px;" name="price" pattern="[0-9.]+" title="Numbers only and must be separated by (.) e.g. 1.2.3 see note above." placeholder="Write a price" value="{{$data->price}}" required>
			</div>

			<div class="col-sm-2 mt-1">
				<label>Kilos</label>
  				<input style="color: black; width:175px;" name="kilos" pattern="[0-9.]+" title="Numbers only and must be separated by (.) e.g. 1.2.3 see note above." placeholder="Enter kilo(kg)" value="{{$data->kg}}" required>
  			</div>

			<div class="col-sm-2 mt-1">
				<label>Store</label>
  				<input style="color: black; width:175px;" name="store_quantity" pattern="[0-9.]+" title="Numbers only and must be separated by (.) e.g. 1.2.3 see note above." placeholder="Enter product quantity" value="{{$data->store_quantity}}" required>
  			</div>
			
			  <div class="col-sm-3 mt-1">
				<label>Warehouse</label>
  				<input style="color: black; width:175px;" name="warehouse_quantity" pattern="[0-9.]+" title="Numbers only and must be separated by (.) e.g. 1.2.3 see note above." placeholder="Enter product quantity" value="{{$data->warehouse_quantity}}" required>
  			</div>

			<div class="mt-1">
  				<label>Insert Image</label>
  				<input style="color: white; " type="file" name="image">
  			</div>
		</div>

  			<div align="center">
			  <div class="col-sm-2 m-2">
  				<label >Old Product</label>
				<img height="350" width="150" style="display:in-line block;" src="/productimage/{{$data->image}}">
			</div>
			</div>
  			<div align="center">
  				<label>New Image</label>
  				<input style="color: white; margin:1%;" type="file" alt="/productimage/{{$data->image}}" name="image">
  			</div>

  			<div align="center"	>
			  <input type="submit" value="SAVE" class="btn btn-success btn-m">
  			</div>
  		</form>

  		<div>




  </div>

  	@include("admin.adminscript")
       
	<script>
	$('#option_type').change(function(){
	 if($('#option_type').val() == 'store_sold'){
		$('#kg').prop('disabled', false);
		$('#paid').prop('disabled', false);
		$('#sold_qty').prop('disabled', false);
		$('#sold_btn').prop('disabled', false);
		document.getElementById('location').value = 'store';
	 }else{
		$('#kg').prop('disabled', false);
		$('#paid').prop('disabled', false);
		$('#sold_qty').prop('disabled', false);
		$('#sold_btn').prop('disabled', false);
		document.getElementById('location').value = 'warehouse';
	 }
	 })
	 
</script>    

  </body>
</html>