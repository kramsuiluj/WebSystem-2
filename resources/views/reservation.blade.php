<?php
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
        <link rel="icon" href="{{ url('assets/images/rice.png') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/images/') }}">
    <!-- Additional CSS Files --> 
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-klassy-cafe.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    
    <body>
        @include('sweetalert::alert')
    
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
                           	
                        
                            <!-- <li class="submenu">
                                <a href="javascript:;">Drop Down</a>
                                <ul>
                                    <li><a href="#">Drop Down Page 1</a></li>
                                    <li><a href="#">Drop Down Page 2</a></li>
                                    <li><a href="#">Drop Down Page 3</a></li>
                                </ul>
                            </li> -->
                       
                            <li><a href="{{url('/product')}}">Products</a></li>
                            <li ><a href="{{url('/staffs')}}">Staffs</a></li> 
                            
                            
                            <li ><a href="{{url('/reservation')}}" class="active"><u>Make a Reservation</u></a></li> 
                            <li>
                      
                        <li>
                        @auth
                        @php $encryption_id = Crypt::encrypt(Auth::user()->id);@endphp
                        <a href="{{url('/showcart',$encryption_id)}}">
                        Cart ({{$count}})
                        </a>
                        @endauth
                    
                        @guest
                        <a href="{{url('/login')}}">
                        Cart</a>
                        @endguest
                        </li> 
                        @auth
                        <li ><a href="{{url('/chatify')}}">Chatify</a></li> 
                        @endauth
                <li>
                @if (Route::has('login'))
                    @auth
                    <li ><a href="{{ route('profile.show') }}">Profile</a></li> 
                        <li ><form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                            </a>
                            </form></li> 
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
                        <div class="section-heading">
                            <h6>Contact Us</h6>
                            <h2>Here you can Make A Reservation for the rice that you desire</h2>
                        </div>
                        <p>Instruction: Fill up the data needed to make a reservation and go to cart to see your reserved products and pay online. The admin then will be managing your reservations after the payment.</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="phone">
                                    <i class="fa fa-phone"></i>
                                    <h4>Phone Numbers</h4>
                                    <span><a href="#">0930-151-3338</a><br><a href="#">0927-201-7039</a></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="message">
                                    <i class="fa fa-envelope"></i>
                                    <h4>Emails</h4>
                                    <span><a href="https://mail.google.com/mail/u/0/?ogbl#inbox?compose=new">lailaownerzgmail.com</a><br><a href="https://mail.google.com/mail/u/0/?ogbl#inbox?compose=new">Lailaowner@gmail.com</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form">
                        <form id="contact" action="{{url('/reservation')}}" method="post" enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                            <div class="col-lg-12">
                                <h4>RiceServations</h4>
                            </div>

                            <div class="col-lg-12 col-sm-12" align="center">
                            <select name="option" id="option_type" class="form-design" style="width:350px; border: 1px solid grey; color:black;" required>
                            <option value="" class="text-center" selected disabled>Please select how will you take it...</option>
                            <option value="Walk in" class="text-center">Walk in</option>
                            <option value="Deliver" class="text-center">Deliver</option>
                            </select>
                            </div>
                            @auth
                            <div class="col-lg-12 col-sm-12" align="center">
                            	<input class="form-design" id="address" type="text" name="address" placeholder="Enter your address" value="{{$data2->address}}" hidden required="">
                            </div>
                            @endauth
                            @guest
                            <div class="col-lg-12 col-sm-12" align="center">
                            	<input class="form-design" id="address" type="text" name="address" placeholder="Enter your address" hidden required="">
                            </div>
                            @endguest
                            <div class="col-lg-6">
                                <div id="filterDate2">    
                                  <div class="input-group date" data-date-format="MM/DD/YYYY">
                                    <input class="form-design" name="date" id="date" type="text" class="form-control" placeholder="MM/DD/YYYY" required="" readonly hidden>
                                    <div class="input-group-addon" >
                                      <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                  </div>
                                </div>   
                            </div>
                            <div class="col-md-6 col-sm-12">
                            	<input class="form-design" type="time" id="time" name="time" required="" hidden>
                            </div>

            <div class="col-lg-12 text-center m-1" >
            <h5>~ PRODUCTS ~</h5>
            </div>

        <div class="row col-12">
        @foreach($data as $data)
                <div class="row sm-6 ml-4 mb-1" class="no-gutters" style="height:25px; width: auto;">
                    <p class='text-dark mr-2'><input type="checkbox" name="prod_name[]" value="{{$data->title}}" id="checkitem" class="check-cls"/> {{$data->title}}</p>
                    <p class='text-dark'>Qty:</p><input style="width:80px; height:25px;" type="number" name="prod_qty[{{$data->title}}]" min="1" value="1" class="form-control ml-2">
                    <input type="hidden" name="product_fee[{{$data->title}}]" value="{{$data->price}}">
                    <input type="hidden" name="prod_id[{{$data->title}}]" value="{{$data->id}}">
                </div>
          @endforeach
        </div>

        <div class="err col-lg-12 text-center mt-2"> Select atleast 1 Product!</div>
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
        </div>
    </section>
    <!-- ***** Reservation Area Ends ***** -->
        
    
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
            $('#date').attr('hidden', false);
            $('#time').attr('hidden', false);
            $('#date').prop('disabled', false);
            $('#time').prop('disabled', false);
            $('#address').attr('hidden', true);
        }else{
            $('#date').attr('hidden', true);
            $('#time').attr('hidden', true);
            $('#date').prop('disabled', true);
            $('#time').prop('disabled', true);
            $('#address').attr('hidden', false);
        }

    })
</script>

<!-- <script>
    var date = new Date();
    var tday = date.getDate();
    var tmonth = date.getMonth() + 1;
    if(tday<10){
        tday = '0'+tday;
    }
    if(tmonth<10){
        tmonth = '0'+tmonth;
    }
    var year = date.getUTCFullYear();
    var minDate = year.'-'.month.'-'.tday;
    document.getElementById('date').setAttribute('min',minDate);
</script> -->


</body>
</html>

