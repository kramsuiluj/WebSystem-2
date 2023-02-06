<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- plugins:css -->

    @include("admin.admincss")
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
	<link href="{{ asset('css/apps.css') }}" rel="stylesheet">

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.0/sweetalert2.css" integrity="sha512-JzSVRb7c802/njMbV97pjo1wuJAE/6v9CvthGTDxiaZij/TFpPQmQPTcdXyUVucsvLtJBT6YwRb5LhVxX3pQHQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="assets/css/style.css">
      <style>
          #nav-container {
              position: fixed;
          }
      </style>
  </head>
  <body>


        <!-- partial:partials/_navbar.html -->

      <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <ul class="navbar-nav w-100">
        </ul>
        <button class="navbar-toggler navbar-toggler-left w-auto btn-lg d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          {{-- <span class="mdi mdi-format-line-spacing"></span> --}}
          {{-- <i class="fas fa-sliders-h"></i> 000--}}
          <i class="fas fa-bars"></i>
        </button>
      </div>
      {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> --}}
      <nav class="sidebar h-100 sidebar-offcanvas" id="sidebar" >

        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top " >
          <a style=" line-height: 100px;
                    color: #fff;
                    font-size: 28px;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 2px;
                     float: left;">
        <img src="assets/images/rice.png" alt="logo" /></a>
        </div>
        <br>
        <ul id="nav-container" class="nav">
          <li class="nav-item nav-category">
            <span class="nav-link text-dark">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('/')}}">
              <span class="menu-icon ">
                <i class="mdi mdi-view-dashboard text-dark"></i>
              </span>
              <span class="menu-title text-dark">Dashboard</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('/walkin')}}">
              <span class="menu-icon ">
                <i class="mdi mdi-walk text-dark"></i>
              </span>
              <span class="menu-title text-dark">Walk In</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('/users')}}">
              <span class="menu-icon">
                <i class="mdi mdi-account-multiple text-dark"></i>
              </span>
              <span class="menu-title text-dark">Users</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('/productmenu')}}">
              <span class="menu-icon">
                <i class="mdi mdi-table-large text-dark"></i>
              </span>
              <span class="menu-title text-dark">Products</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('/viewstaffs')}}">
              <span class="menu-icon">
                <i class="mdi mdi-account-card-details text-dark"></i>
              </span>
              <span class="menu-title text-dark">Staffs</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('/viewreservation')}}">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar text-dark"></i>
              </span>
              <span class="menu-title text-dark">Reservations</span>
            </a>
          </li>
          @if(auth()->user()->access_level == 2)
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('/supplyreceipt')}}">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box text-dark"></i>
              </span>
              <span class="menu-title text-dark">Receipt</span>
            </a>
          </li>
          @endif

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('/chatify')}}">
              <span class="menu-icon">
                <i class="mdi mdi-chat text-dark"></i>
              </span>
              <span class="menu-title text-dark">Chatify</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('profile.show') }}">
              <span class="menu-icon">
                <i class="mdi mdi-account text-dark"></i>
              </span>
              <span class="menu-title text-dark">Profile</span>
            </a>
          </li>


          <li class="nav-item menu-items">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                  <a class="nav-link" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                        this.closest('form').submit();">
                      <span class="menu-icon">
                        <i class="mdi mdi-account-remove text-danger"></i>
                      </span>
                    <span class="menu-title text-danger">Logout</span>
                  </a>
            </form>
          </li>
        </ul>
      </nav>
      <!-- partial -->

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
