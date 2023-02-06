<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
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
      <div class="row">
        <h1 class="mt-1 mb-2 h4 mb-0 text-gray-800">Walk-In Management</h1>
        <br>			
      </div>
      <div class="row">
      <div class="col-lg-5 mb-5">
        <div class="card card card-raised h-100  ">
            <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
              Walk-In Customer
            </div>
            <div class="card-body bg-white">
                <!-- <canvas id="myAreaChart" width="100%" height="40"> -->
                    <div class="col-lg-12 " >
                      <div class="contact-form">
                        <form id="contact" action="{{url('/delivered')}}" method="post" enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                            <div class="col-lg-12">
                                <h5 class='text-dark mt-3'>Approved {{$data->buy_option}} Request by {{$data->name}}</h5>
                                <input type="hidden" name="buy_option" value="{{$data->buy_option}}">
                            </div>

                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                              <h6 class="form-design" name="name"><u>NAME</u><br>{{$data->name}}</h6>
                              <input name="name" type="hidden" value="{{$data->name}}">
                            </fieldset>
                            </div>
                            
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                              <h6  class="form-design" name="email" ><u>EMAIL</u><br>{{$data->email}}</h6>
                              <input name="email" type="hidden" value="{{$data->email}}">
                            </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                                <h6  class="form-design" name="phone" type="number" ><u>CONTACT</u><br>{{$data->phone}}</h6>
                                <input name="phone" type="hidden" value="{{$data->phone}}">
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <h6  class="form-design" name="address" ><u>ADDRESS</u><br>{{$data->address}}</h6>
                              <input name="address" type="hidden" value="{{$data->address}}">
                            </div> 

                            <div class="col-md-6 col-sm-12">
                            <h6  class="form-design" type="text" name="date"><u>DATE(MM/DD/YYYY)</u><br>{{$data->date}}</h6>
                            <input name="date" type="hidden" value="{{$data->date}}">
                            </div> 
                            <div class="col-md-6 col-sm-12">
                            <h6  class="form-design" type="text" name="time"><u>TIME</u><br>{{$data->time}}</h6>
                            <input name="time" type="hidden" value="{{$data->time}}">
                            <input name="refno" type="hidden" value="{{$data->refno}}">
                            </div>            
                          </div>
                        </div>
                      </div>              
                    </table>
                  </div>
                </div>
              </div>
                <!-- </canvas> -->

                <div class="col-lg-3 mb-5">
                  <div class="card card card-raised h-100  ">
                    <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
                      Products
                      </div>
                        <div class="card-body bg-white">
                          <!-- <canvas id="myAreaChart" width="100%" height="40"> -->
                              <div class="col-lg-12 " >
                                <div class="row">
                                  <div class="col-lg-12 text-center m-1">
                                    <div class="text-center m-1">
                                          <?php $total=0; ?>
                                          @foreach($reserved_products as $reserved_products)
                                          <thead> 
                                            <tr>
                                                <h6 class='text-dark'> {{$reserved_products->reserved_qty}} sacks of {{$reserved_products->productz}}</h6> 
                                                
                                                <input type="hidden" name="id[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->prod_id}}">
                                                <input type="hidden" name="prod_name[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->productz}}"/>
                                                <input type="hidden" name="prod_kg[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->kg}}"/>
                                                <input type="hidden" name="reserved_qty[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->reserved_qty}}">
                                                <input type="hidden" name="price[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->price}}">
                                                <input type="hidden" name="product_fee[{{$reserved_products->prod_id}}{{$reserved_products->kg}}]" value="{{$reserved_products->product_fee}}">
                                            </tr>
                                          </thead>
                                            <?php 
                                              $total += $reserved_products->product_fee;
                                            ?>
                                          @endforeach
                                          <br>
                                          <h6 class='text-dark'>
                                            <?= "TOTAL: ".$total; ?>
                                            </h4>
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
                                                                    <button name="submit" type="submit" id="form-submit"  class="submit-btn btn btn-success">DONE</button>
                                                                </div>
                                                              </div>
                                                            </form>
                                                        </div>
                                                    </div> 
                                                    </div>
                                                  </div>
                
                                                  <div class="col-lg-4 mb-5">
                                                    <div class="card card card-raised h-100 bg- ">
                                                     <div class="card-header text-dark bg-success px-4" style="background-color:#198754 !important">
                                                    Image
                                                    </div>
                                                        <div class="card-body bg-white">
                                                            <!-- <canvas id="myAreaChart" width="100%" height="40"> -->
                                                              <div align="center" class="col-sm">
                                                                  
                                                                    @foreach($user_img as $user_img)
                                                                    @if($user_img->profile_photo_path == null)
                                                                    <img style="border-radius:100%;  height:50px; width:auto;" src="assets/images/anonymous.jpg" title="assets/images/anonymous.jpg" id="zoomID" onclick="enlargeImg()">
                                                                    @else
                                                                    <img style="border-radius:100%;  height:50px; width:auto;" src="storage/{{$user_img->profile_photo_path}}" title="assets/images/anonymous.jpg" id="zoomID" onclick="enlargeImg()">
                                                                    @endif
                                                                    
                                                                    <br>
                                                                    <div align="center" class="col-sm">
                                                                    <button onclick="resetImg()" id ="hideBtn" hidden><p class="text-black ml-2">Minimize</p></button>
                                                                    @if($reserved_products->qr == null)
                                                                    <img id="locImg" style=" height:200px; width:200px;" src="qr_imgs/qr_sample.jpg" alt="">
                                                                    @else
                                                                    <img id="locImg" style=" height:200px; width:200px;" src="qr_imgs/{{$reserved_products->qr}}" alt="">
                                                                    @endif
                                                                    @endforeach

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
  	   </div>   
  </body>
</html>