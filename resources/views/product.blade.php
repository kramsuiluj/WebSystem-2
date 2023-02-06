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

    
    </head>
    
    <body>
        
    <script>
  $(document).ready(function (){
    $(document).on('click','#reserveBtn', function(){

      var prod_id = $(this).val();
      showModal();

      $.ajax({
        type: 'GET',
        url: '/get_reserve/'+ prod_id,
        success: function(response){
          $('#address').val(response.user.address);
          var get_kilos = response.product.kilos;
        }
      })


    });
  });
</script>
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
                           <img src="assets/images/rice.png" align="klassy cafe html template">

                           <a class="menu-trigger">
                               
                                <span>Menu</span>

                           </a>
                        </a>
                        
                        <ul class="nav">
                            <li ><a href="{{url('/')}}">Home</a></li>
                           	
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
                            <li><a href="{{url('/product')}}" class="active"><u>Products</u></a></li>
                            <li class="scroll-to-section"><a href="{{url('/staffs')}}">Staffs</a></li> 
                            
                            
                            
                            <li>
                      
                        <li class="scroll-to-section" >
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

    <div class="container">
            <div class="row">
                <div id="top" class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                        <h6>Our Products</h6>
                        <h2>Our selection of Quality Rice</h2>
                        @forelse($data as $datas)
                        @empty
                        <br><br><h2 style="color:#fb5849;">Nothing to see here..</h2>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center m-1">     
    @foreach($data as $data)
    @include('modal')

                   <div style="margin:5px;">
                        <div style="background-image: url('/productimage/{{$data->image}}'); " class='card'>
                            <div class="title">
                                <h6>{{$data->title}}</h6>
                            </div>
                            <div class='info'>
                              <h4 class='description'>{{$data->description}}</h4>
                              <h3 class='sulat'>
                              <?php 
    				            $kilos = explode('.',$data->kg);
    				            $store = explode('.',$data->store_quantity);
                                echo "<u>Available in store</u>";
   					            for($i=0;$i<count($store);$i++) {
                                if($store[$i] != 0){
                                    echo '<br/>'.$store[$i].' stacks of '.$kilos[$i].'kg';
                                }
    				            }
					            ?>	
                              </h3>    
                              <h3 class='sulat'>
                              <?php 
    				            $kilo = explode('.',$data->kg);
    				            $warehouse = explode('.',$data->warehouse_quantity);
                                echo "<u>Available in warehouse</u>";
   					            for($i=0;$i<count($warehouse);$i++) {
                                if($warehouse[$i] != 0){
                                    echo '<br/>'.$warehouse[$i].' stacks of '.$kilo[$i].'kg';
                                }
    				            }
					            ?>	
                            </h3> 
   
                            </div>
                        </div> 
                      <div class="col-lg-12 text-center mt-1">
                      @auth
                        <button id="reserveBtn" style="background-color:#fb5849;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$data->id}}" >ADD TO CART</button>
                      @endauth
                      @guest
                      <a class="btn btn-danger" href="{{url('/login')}}">ADD TO CART</a>
                      @endguest
                      </div>    
                    </div>

                    @endforeach
                    </div>
        </div>
@include("bar-chart")

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
