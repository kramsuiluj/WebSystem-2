<!DOCTYPE html>
<html lang="en">
	
  <head>
	<style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width:100%;
			color:black;
        }
        #emp td, #emp th{
            border:1px solid black;
            padding: 8px;
        }
        #emp tr{
            background-color: #fff;
        }
        #emp th{
            padding-top:12px;
            padding-bottom:12px;
            text-align:center;
            background-color: grey;
            color:#fff;
        }
		#downloadButton {
  		margin: 5px;
 		font-size: 13px;
  		color: #fff;
  		background-color: #4CAF50;
  		padding: 12px 25px;
  		width: 10%;
  		box-shadow: none;
  		border: none;
  		display: inline-block;
  		border-radius: 3px;
  		font-weight: 600;
  		transition: all .3s;
		}
		#backButton {
  		margin: 5px;
 		font-size: 13px;
  		color: #fff;
  		background-color: skyblue;
  		padding: 12px 25px;
  		width: 10%;
  		box-shadow: none;
  		border: none;
  		display: inline-block;
  		border-radius: 3px;
  		font-weight: 600;
  		transition: all .3s;
		}

    </style>
    
  </head>
  <body>
    
  	<div class="container-scroller">
  		<div align="center">
		  <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets/images/rice.png')))}}">
		  
		  <h3 class="text-center mt-3">~Transaction Report with Supplier~</h3>
  			<table id="emp" style="width:100px; margin-left:6%;">
			  <thead>  
  				<tr>
				  <th >Recipient</th>
  					<th >Product</th>
					<th >Quantity</th>
  					<th >Paid Amount</th>
					<th >Total Fee</th>
  					<th >Date</th>
					<th >Image</th>
  				</tr>
				</thead>  
		<tbody>
			
  				@foreach($data as $data)
  				<tr align="center">
				  <td>{{$data->recipient}}</td>
  					<td>{{$data->prod_name}}</td>
  					<td>{{$data->prod_qty}}</td>
					<td>{{$data->paid_fee}}</td>
  					<td>{{$data->total_fee}}</td>
					<td>{{$data->date}}</td>
  					<td><img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('public/productimage/'.$data->proof))); ?>" width="120"></td>
  				</tr>
  				@endforeach
		</tbody>
  			</table>
  		</div>
  	</div>
  </body>
</html>