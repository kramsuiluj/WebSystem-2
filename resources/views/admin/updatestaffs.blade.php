<!DOCTYPE html>
<html lang="en">
  <head>

  	<base href="/public"> 
    @include("admin.admincss")
	</script>  
      <style>
      @media (max-width:645px) {
        .row{
          margin-top:10%;
        }
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">

  	@include("admin.navbar")

<div style="position: relative; margin-top:6%; right: -10px;">

  	<form action="{{url('/updatestaff',$data->id)}}" method="Post" enctype="multipart/form-data">


  		@csrf
	<div class="row ">
  		<div class="col-sm-4 m-2">
  			<label>Staffs Name</label>
  			<input style="color: black; width:170px;"type="text" name="name" placeholder="Enter name" value="{{$data->name}}">
  		</div>

  		<div class="col-sm-4 m-2">
  			<label >Contact</label>
  			<input style="color: black; width:185px;" type="text" name="speciality" placeholder="Enter available contact" value="{{$data->speciality}}">
  		</div>
		  </div>
  		<div>
  			<label class="text-center m-2"l>Old Image: </label>
  			<img height="200" width="200" src="/staffsimage/{{$data->image}}">
  		</div>

  		<div>
  			<label class="text-center m-2">New Image</label>
  			<input type="file" name="image">
  		</div>

  		<div class="text-center m-2"> 
  			<input class="btn btn-success "  type="submit" value="SAVE" required="">
  		</div>
	

  	</form>
	  </div>

  </div>

  	@include("admin.adminscript")
       
   
  </body>
</html>