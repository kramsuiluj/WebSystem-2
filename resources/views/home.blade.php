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
    <main>
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
                           <img src="{{ url('assets/images/rice.png') }}" align="klassy cafe html template">
                           <a class="menu-trigger">
                                <span>Menu</span>
                           </a>
                        </a>

                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active"><u>Home</u></a></li>


                            <li><a href="{{url('/product')}}">Products</a></li>
                            <li ><a href="{{url('/staffs')}}">Staffs</a></li>



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
                    <li >
                        <a href="{{ route('profile.show') }}">Profile</a></li>
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
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-content">
                        <div class="inner-content">
                            <h4>RJF Rice Dealer</h4>
                            <h6>THE BEST RICE DEALER</h6>
                            <div class="main-white-button scroll-to-section">
                                <a href="{{url('/product')}}">Make A Reservation</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="main-banner header-text">
                        <div class="Modern-Slider">
                          <!-- Item -->
                          <div class="item">
                            <div class="img-fill">

                                <img src="{{ url('assets/images/farm1.jpg') }}" alt="">
                            </div>
                          </div>
                          <!-- // Item -->
                          <!-- Item -->
                          <div class="item">
                            <div class="img-fill">
                                <img src="{{ url('assets/images/farm2.jpg') }}" alt="">
                            </div>
                          </div>
                          <!-- // Item -->
                          <!-- Item -->
                          <div class="item">
                            <div class="img-fill">
                                <img src="{{ url('assets/images/farm3.jpg') }}" alt="">
                            </div>
                          </div>
                          <!-- // Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** About Area Starts ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h6>About Us</h6>
                            <h2>We Offer A Nutritious Rice For You</h2>
                        </div>
                        <p>A company that sells a particular product such as rice, has permission to sell and ensures that they always have enough stock and is located across the country are called Rice Dealers.</p>
                        <p>To ensure food security and stable rice supply and prices. Rhea Jhong Forever (RJF) Rice Dealer produces not just one type of rice but produces different types of rice that are also affordable to anyone and providesprovide good services to every consumer. Rhea Jhong Forever (RJF) Rice Dealer ensures that everyone receives a good quality of rice for the right price.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <!-- <div class="right-content"> -->

                        <div >
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3224.9658165082374!2d120.53165916739499!3d16.005585676942268!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaa42b0d5f1ec5e88!2zMTbCsDAwJzE4LjciTiAxMjDCsDMxJzU3LjciRQ!5e0!3m2!1sen!2sph!4v1674358557483!5m2!1sen!2sph" width="560" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- ***** About Area Ends ***** -->
                        </main>


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
