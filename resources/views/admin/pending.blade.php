<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
    @include("admin.admincss")
    <link href="{{ asset('css/apps.css') }}" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>  
  
  <script>
    $( function() {
      $( "#date" ).datepicker({
                  minDate: 0
              });
    } );
    </script>    

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
        <h1 class="mt-1 mb-2 h4 mb-0 text-gray-800">Reservation Management</h1>		
      </div>
      <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card card card-raised h-100  ">
            <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
                Pending Reservations
            </div>
            <div class="card-body bg-white">
                <!-- <canvas id="myAreaChart" width="100%" height="40"> -->
                     <div class="row">
                      <div class="col-lg-12 " >
                        <div class="contact-form">
                          <?php $total_qty=0; ?>
                          @foreach($reserved_products as $check_qty)
                          <?php 
                          $total_qty += $check_qty->reserved_qty; 
                          ?>
                          @endforeach
                            @if($data->discount == 0 && $total_qty>=10)
                            <form id="contact" action="{{url('/set_discount')}}" method="post" enctype="multipart/form-data">
                            @else
                              <form id="contact" action="{{url('/approveReserve')}}" method="post" enctype="multipart/form-data">
                            @endif
                              @csrf
                                <div class="row">
                                  <div class="col-lg-12">
                                      <h3 class='text-dark mt-3 mb-5'>Pending {{$data->buy_option}} Request by {{$data->name}}</h3>
                                      <input type="hidden" name="buy_option" value="{{$data->buy_option}}">
                                  </div>
        
                                  <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                    <h5 style="color:black; margin-top:1px;" class="form-design" name="name"><u>NAME</u><br>{{$data->name}}</h5>
                                  </fieldset>
                                  </div>
                                  
                                  <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                    <h5 style="color:black; margin-top:1px;" class="form-design" name="email" ><u>EMAIL</u><br>{{$data->email}}</h5>
                                  </fieldset>
                                  </div>
                                  <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                      <h5 style="color:black; margin-top:1px; width:250px;" class="form-design" name="phone" type="number" ><u>CONTACT</u><br>{{$data->phone}}</h5>
                                    </fieldset>
                                  </div>
                                  <div class="col-md-6 col-sm-12">
                                    <h5 style="color:black; margin-top:1px;" class="form-design" name="address" ><u>ADDRESS</u><br>{{$data->address}}</h5>
                                  </div> 
                        @if($data->buy_option == 'Walk in')
                            <div class="col-md-6 col-sm-12">
                              <h5 style="color:black; margin-top:1px;" class="form-design" type="text" name="date"><u>DATE(MM/DD/YYYY)</u><br>{{$data->date}}</h5>
                            </div> 
                            <div class="col-md-6 col-sm-12">
                              <h5 style="color:black; margin-top:1px;" class="form-design" type="text" name="time"><u>TIME</u><br>{{$data->time}}</h5>
                            </div> 
                        @else
                          @if($data->discount == 0 && $total_qty>=10)
                          @else
                            <div class="col-md-6 col-sm-12">
                              <h6 style="color:black;"><u>SET DATE:</u></h6>
                              <input style="color:black; margin-top:1px;width:150px;" class="form-design" type="text" id="date" name="date" value="{{$data->date}}" autocomplete="off" placeholder="mm/dd/yyyy" required>
                            </div> 
                            <div class="col-md-6 col-sm-12">
                                <h6 style="color:black;"><u>SET TIME:</u></h6>
                            <input style="color:black; margin-top:1px; width:150px;" class="form-design" type="time" id="time"name="time" required>
                            </div> 
                          @endif
                        @endif
                      </div> 
                    </div> 
                    </div>
                  </div>
                <!-- </canvas> -->
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
      <div class="card card card-raised h-100  ">
          <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
              Products
          </div>
          <div class="card-body bg-white">
              <!-- <canvas id="myAreaChart" width="100%" height="40"> -->
                <div class="row">  
                <div class="col-lg-12 " >
                  <div class="col-lg-12 text-center m-1">
                    <div class="text-center m-1">
                    <?php $total=0; ?>
                @foreach($reserved_products as $reserved_products)
                  <h4 class='text-dark mr-2'> {{$reserved_products->reserved_qty}} sacks of {{$reserved_products->kg}}kg of {{$reserved_products->productz}} for {{$reserved_products->product_fee}}</h4> 
                  @if($reserved_products->discount == 0 && $total_qty>=10)
                    <input type="number" name="set_discount[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" placeholder="Set New Amount" value="{{$reserved_products->product_fee}}" min="0" max="{{$reserved_products->product_fee}}"/>
                 @endif
                    <input type="hidden" name="id[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->prod_id}}">
                    <input type="hidden" name="prod_name[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->productz}}"/>
                    <input type="hidden" name="prod_kg[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->kg}}"/>
                    <input type="hidden" name="reserved_qty[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->reserved_qty}}">
                    <?php 
                   $total += $reserved_products->product_fee;
                    ?>
                @endforeach
                    <br>
                    <h6 class='text-dark'>
            
                    <?php 
                    if($data->discount == 2){
                      echo"TOTAL: ".$total." - DISCOUNTED";
                    }else{
                      echo"TOTAL: ".$total;
                    }
                    ?></h6>

                    <h6 class='text-dark'>
                    <?php
                        if($reserved_products->refno != null){
                        echo "Ref no: ".$reserved_products->refno;
                        }else{
                          echo "Ref no: Nothing set.";
                        }
                    ?>
                    </h6>
                    
                    </div>
                    </div>
                    <input type="text" name="user_id" value="{{$data->user_id}}" hidden>
            
                    <div class="col-lg-12 mb-2 mt-5" align="center">
                              <fieldset>
                              @if($data->discount == 0 && $total_qty>=10)
                              <button name="submit" type="submit" id="form-submit"  class="submit-btn btn btn-success">SET DISCOUNT</button>
                              <a href="{{url('/no_discount',$data->user_id)}}"  type="submit" class="btn btn-danger">DO NOT SET</a>
                              @else
                                <button name="submit" type="submit" id="form-submit"  class="submit-btn btn btn-success">APPROVE</button>
                                 <a href="{{url('/deleteReserve',$data->user_id)}}"  type="submit" class="btn btn-danger">REMOVE</a>
                              @endif 
                              </fieldset>
                          </div>
                      </div>
                  </form>

                  </div>
                </div>
              <!-- </canvas> -->
          </div>
        
      </div>
  </div>

    @include("admin.adminscript")  
  

    <script>
            img = document.getElementById("zoomID");
            // Function to set image dimensions
            function enlargeImg() {
                img.style.width = "60%";
                img.style.height = "auto";
                img.style.transition = "width 0.5s ease";
                $('#hideBtn').attr('hidden', false);
                $('#locImg').hide();
            }
            // Function to reset image dimensions
            function resetImg() {
                img.style.width = "auto";
                img.style.height = "50px";
                img.style.transition = "width 0.5s ease";
                $('#hideBtn').attr('hidden', true);
                $('#locImg').show();
            }
        </script>
       
  </body>
</html>