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
                            <li class="scroll-to-section"><a href="{{url('/')}}">Home</a></li>
                           	
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
                            <li><a href="{{url('/staffs')}}" class="active"><u>Staffs</u></a></li> 
                            
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
<section class="section" id="chefs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                        <h6>Our Staffs</h6>
                        <h2>We offer the best Rice for you</h2>
                    </div>
                </div>
            </div>

            

            <div class="row">

                @foreach($data2 as $data2)

                <div class="col-lg-4">
                    <div class="chef-item">
                        <div class="thumb">
                            <div class="overlay"></div>
                            <!-- <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul> -->
                            <img height="300" width="200" src="staffsimage/{{$data2->image}}" alt="Chef #1">
                        </div>
                        <div class="down-content">
                            <h4>{{$data2->name}}</h4>
                            <span>{{$data2->speciality}}</span>
                        </div>
                    </div>
                </div>


                @endforeach

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
  </body>
</html>