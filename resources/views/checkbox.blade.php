<!DOCTYPE html>
<html lang="en">



  <head>
    

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>MyCheckbox</title>

 

    </head>
    
    <body>
    <form action="{{url('/product')}}" method="POST">
      @csrf
    <div class="row">
                  <div class="col-sm-3">
                    <p class='mybox text-dark'><input type="checkbox" name="books[]" value="Chemistry"/>Chemistry
                    <input type="hidden" name="books_name[]" value="Chemistry">

                    <input type="number" name="books_qty[]" min="1" value="1"class="form-control"></div>
                <div class="col-sm-3">
                    <p class='mybox text-dark'><input type="checkbox" name="books[]" value="English"/>English
                    <input type="hidden" name="books_name[]" value="English">

                    <input type="number" name="books_qty[]" min="1" value="1"class="form-control"></div>
                <div class="text-center m-2">
                    <button class="btn btn-info btn-m text-center" type="submit" name="submit">Submit</button>
                </div>
                </div>
    </form>
  </body>
</html>

11/13/2022 old code inside reservation
<!-- <?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">


  <head>
    

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>RiceServation</title>

     Additional CSS Files -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-klassy-cafe.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type ="text/javascript" src="jquery-3.5.0.min.js"></script>
    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                       <a href="#top" class="logo">
                           <img src="assets/images/rice.png">

                           <a class="menu-trigger">
                               
                                <span>Menu</span>

                           </a>
                        </a>
                        
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{url('/')}}">Home</a></li>
                            <li class="scroll-to-section"><a href="{{url('/')}}">About</a></li>
                           	
                        <!-- 
                            <li class="submenu">
                                <a href="javascript:;">Drop Down</a>
                                <ul>
                                    <li><a href="#">Drop Down Page 1</a></li>
                                    <li><a href="#">Drop Down Page 2</a></li>
                                    <li><a href="#">Drop Down Page 3</a></li>
                                </ul>
                            </li>
                        -->
                            <li><a href="{{url('/product')}}">Products</a></li>
                            <li ><a href="{{url('/staffs')}}">Staffs</a></li> 
                            
                            
                            <li ><a href="{{url('/reservation')}}" class="active"><u>Make a Reservation</u></a></li> 
                            <li>
                      
                        <li>
                        @auth
                        <a href="{{url('/showcart',Auth::user()->id)}}">
                        Cart ({{$count}})
                        </a>
                        @endauth
                    
                        @guest
                        <a href="{{url('/login')}}">
                        Cart</a>
                        @endguest
                     
                        </li> 
                <li>
                @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                       <li><x-app-layout>
    
							</x-app-layout></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a></li>

                        @if (Route::has('register'))
                           <li><a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a></li>
                        @endif
                    @endauth
                </div>
            @endif
                            </li>
                        </ul>        
                        <a class='menu-trigger'>
                            
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
<!-- ***** Reservation Us Area Starts ***** -->
    <section class="section" id="reservation">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="left-text-content">
                    <div class="contact-form">
                        <form id="contact" action="{{url('/reservation')}}" method="post" enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                            <div class="col-lg-12">
                                <h4>RiceServation</h4>
                            </div>

                            @guest
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                                <input class="form-design" name="name" type="text" id="name"  placeholder="Your Name*" required="">
                            </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                              <input class="form-design" name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" required="">
                            </fieldset>
                            </div>
                            @endguest
                            @auth
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                                <input class="form-design" name="name" type="text" id="name" value="{{$data2->name}}" placeholder="Your Name*" required="">
                            </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                              <input class="form-design" name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" value="{{$data2->email}}" placeholder="Your Email Address" readonly>
                            </fieldset>
                            </div>
                            @endauth
                            <div class="col-lg-6 col-sm-12">
                                <fieldset>
                                <input 
                                class="form-design"
                                style="margin-top:2px;"
                                name="phone"
                                id="phone"
                                min="0"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                type = "number"
                                maxlength = "11"
                                placeholder="Phone Number*" 
                                required=""
                                />
                            </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              
                            	<input class="form-design" type="text" name="address" placeholder="Address" required="">

                            </div>

                            <div class="col-lg-12 col-sm-12" align="center">
                            <select name="option" id="option_type" class="form-design" style="width:350px;" required>
                            <option value="" class="text-center" selected disabled>Please select how will you take it...</option>
                            <option value="Walk in" class="text-center">Walk in</option>
                            <option value="Deliver" class="text-center">Deliver</option>
                            </select>
                            </div>

                            <div class="col-lg-6">
                                <div id="filterDate2">    
                                  <div class="input-group date" data-date-format="dd/mm/yyyy">
                                    <input class="form-design" name="date" id="date" type="text" class="form-control" placeholder="dd/mm/yyyy" required="" disabled>
                                    <div class="input-group-addon" >
                                      <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                  </div>
                                </div>   
                            </div>
                            <div class="col-md-6 col-sm-12">
                              
                            	<input class="form-design" type="time" id="time" name="time" required="" disabled>

                            </div>

<div class="col-lg-12 text-center m-1" >
<h5>~ PRODUCTS ~</h5>
</div>

        <div class="row col-12">
        @foreach($data as $data)
                <div class="row sm-6 ml-4 mb-1" class="no-gutters" style="height:25px; width: auto;">
                    <p class='text-dark mr-2'><input type="checkbox" name="prod_name[]" value="{{$data->title}}" id="checkitem" class="check-cls"/> {{$data->title}}</p>
                    <p class='text-dark'>Qty:</p><input style="width:80px; height:25px;" type="number" name="prod_qty[{{$data->title}}]" id="qty" min="1" value="0" class="form-control ml-2">
                    <input type="hidden" name="product_fee[{{$data->title}}]" id="price" value="{{$data->price}}">
                    <input type="hidden" name="prod_id[{{$data->title}}]" value="{{$data->id}}">     
                </div>
          @endforeach
        </div>

        <div class="err col-lg-12 text-center mt-2"> Select atleast 1 Product!</div>
        <div class="col-lg-12 col-sm-12" align="center">
                 <fieldset>
                    <label>Total:</label>
                    <input 
                    style="margin-top:2px;"
                    name="total"
                    id="total"
                    placeholder="0"
                    readonly
                 />
                </fieldset>
            <div class="col-lg-12 col-sm-12" align="center">
                 <fieldset>
                    <label>Enter Ref No. after payment</label>
                    <input 
                    style="margin-top:2px;"
                    name="refno"
                    min="0"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    type = "number"
                    maxlength = "13"
                    placeholder="Enter Ref No. here"
                 />
                </fieldset>
            </div>
                            <div class=" col-lg-12 mt-5">
                              <fieldset>
                                <button name="submit" type="submit" id="form-submit"  class="submit-btn" disabled>Make A Reservation</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>

                    </div>   
                           
                    </div>
                </div>
                <div class="col-lg-6">
        <div>
        <p>Scan the QR Code below to pay online or use the number provided</p>
        <img src="assets/images/qrpayment.jpg">
        </div>
                </div>
            </div>
        </div>
    </section> 

        
    
<!-- jQuery -->
        <script src="assets/js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/accordions.js"></script>
<script src="assets/js/datepicker.js"></script>
<script src="assets/js/scrollreveal.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/imgfix.min.js"></script> 
<script src="assets/js/slick.js"></script> 
<script src="assets/js/lightbox.js"></script> 
<script src="assets/js/isotope.js"></script> 

<!-- Global Init -->
<script src="assets/js/custom.js"></script>
<script>

    $(function() {
        var selectedClass = "";
        $("p").click(function(){
        selectedClass = $(this).attr("data-rel");
        $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("."+selectedClass).fadeOut();
        setTimeout(function() {
          $("."+selectedClass).fadeIn();
          $("#portfolio").fadeTo(50, 1);
        }, 500);
            
        });
    });

</script>

<script>
    $('#option_type').change(function(){
        if($('#option_type').val() =='Walk in'){
            $('#date').show();
            $('#time').show();
            $('#date').prop('disabled', false);
            $('#time').prop('disabled', false);
        }else{
            $('#date').hide();
            $('#time').hide();
            $('#date').prop('disabled', true);
            $('#time').prop('disabled', true);
        }
    })
</script>
<script>
    $(document).ready(function(){
        $("#qty","#price").keyup(function(){
                var total = 0;
                var x = Number($("#qty").val());
                var y = Number($("#price").val());
                var total = x*y; 
                $("#total").val(total);
            
        })
    })
</script>

</body>
</html> -->
