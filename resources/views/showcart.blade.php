<!DOCTYPE html>
<html lang="en">


  <head>
    <base href="/public">
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
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
                            <li class="scroll-to-section"><a href="{{url('/product')}}">Products</a></li>
                            <li class="scroll-to-section"><a href="{{url('/staffs')}}">Staffs</a></li> 
                            
                            <li>
                       
                        <li class="scroll-to-section">
                        @auth
                        @php $encryption_id = Crypt::encrypt(Auth::user()->id);@endphp
                        <a href="{{url('/showcart',$encryption_id)}}" class="active"><u>
                        Cart({{$count}})
                        </u></a>
                        @endauth
                        @guest
                        <a href="{{url('/showcart',Auth::user()->id)}}">
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
    
<div class="row col-lg-12">
    <div id="top" class="col-lg-6  m-1 " >
        <div class="col-lg-12 col-sm-12 mt-3" align="center">
            <select name="option" id="history_type" class="btn btn-info dropdown-toggle" style="width:250px;" required>
                    <option value="Pending" class="text-center" selected >Order Details({{$countpending}})</option>
                    <option value="Approved" class="text-center">Approved Request({{$countapproved}})</option>
                    <option value="History" class="text-center">History({{$counthistory}})</option>
            </select>
        </div>

        <table id="cart-table" class="pendingTable" align="center" >
            <p align="center" class="pending-text"><b>Order Summary</b></p>
            <tr>
                <th class="text-light" style="padding: 10px;">Products</th>
                <th class="text-light"  style="padding: 10px;">Option</th>
                <th class="text-light" style="padding: 10px;">Price</th>
                <th class="text-light" style="padding: 10px;">Quantity</th>
                <th class="text-light" style="padding: 10px;">Fee</th>
            </tr>
            <?php $total=0; $total_qty=0; ?>
            <form  method="post" class="pendingForm">
            @csrf
            @forelse($data as $data)
            <tr>
                <td><input type="checkbox" name="reserved_id[{{$data->id}}]" value="{{$data->id}}" class="check-cls" hidden/>{{$data->kg}}kg {{$data->productz}}</td>
                @if($data->buy_option =="Walk in")
                <td align="center">Walk in at {{$data->date}} at {{$data->time}}</td>
                @elseif($data->buy_option =="Deliver")
                    @if($data->buy_option =="Deliver" && $data->date != null)
                    <td align="center" >{{$data->buy_option}} on {{$data->date}} at {{$data->time}}</td>
                    @else
                    <td align="center">{{$data->buy_option}}</td>
                    @endif
                @else
                <td align="center">N/A</td>
                @endif
                <td align="center">{{$data->price}}</td>
                <td align="center"><label class="qtyLbl">{{$data->reserved_qty}}</label>
                <input type="hidden" name="prod_kilos[]" value="{{$data->kg}}"/>
                <input type="number" style="width:50px;" name="reserved_qty[{{$data->kg}}]" value="{{$data->reserved_qty}}" min="1" max="" class="check-cls" hidden />   
                <input type="hidden" name="prod_name[{{$data->kg}}]" value="{{$data->productz}}">
                <input type="hidden" name="prod_id[{{$data->kg}}]" value="{{$data->prod_id}}">
                </td>
                <td align="center">{{$data->product_fee}}</td>
                @if($data->status =="pending")
                <?php 
                    $total += $data->product_fee;
                    $total_qty += $data->reserved_qty;
                ?>
                @endif
            </tr>
            @empty
            <tr>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
            </tr>

            
            @endforelse
            <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"><b>TOTAL:</b></td>
                <td align="center">
                <?php 
                if($countpending != null){
                if($refno->discount == 1){
                    echo $total." - Discounted";
                }else{
                    echo $total; 
                }
                }?>
                </td>
            </tr>
        </table>

        <div id="manageRes" class="col-lg-12"align="center" style="display:none;">
            <label class="formBtn"> <input type="checkbox" id="checkAll"/><b>SELECT ALL</b> |</label>
            <input formaction="/cancelReserve" type="submit" class="submit-btn" style="margin-left:5px; font-weight:bold; border:1px solid-black;" value="REMOVE" disabled>
            <input formaction="/updateReserve" type="submit" style="margin-left:5px; font-weight:bold; border:1px solid-black;" value="UPDATE">
        </div>
        </form>

        {{--@if($countpending != null)--}}
            {{--@if($data->refno == null)--}}
            <div id="manageDiv" class="col-lg-12"align="center" >
                <input type="submit" class="btn btn-primary" style="margin-top:5px; font-weight:bold; border:1px solid black;" id="manage" value="MANAGE">
            </div>
            {{--@endif--}}
        {{--@endif--}}


        <!-- approved -->
        <table id="cart-table" class="approvedTable" align="center"  hidden>
            <p align="center" style="margin-top:2px;"class="approved-text" hidden><b>APPROVED REQUESTS</b></p>
            <tr>
                <th  class="text-light" style="padding: 5px;">Products</th>
                <th  class="text-light" style="padding: 5px;">Option</th>
                <th  class="text-light" style="padding: 5px;">Price</th>
                <th class="text-light" style="padding: 5px;">Quantity</th>
                <th class="text-light" style="padding: 5px;">Fee</th>
                <th class="text-light" style="padding: 5px;">RefNo</th>
            </tr>
            <?php $total=0; $ref=0;?>

            @forelse($approvedrefno as $approvedrefno)
            <tr>
                <td align="center">{{$approvedrefno->kg}}kg of {{$approvedrefno->productz}}</td>
                <td align="center"  >{{$approvedrefno->buy_option}} at {{$approvedrefno->date}} at {{$approvedrefno->time}}</td>
                <td align="center">{{$approvedrefno->price}}</td>
                <td align="center">{{$approvedrefno->reserved_qty}}</td>
                <td align="center">{{$approvedrefno->product_fee}}</td>
                <td>{{$approvedrefno->refno}}</td>
                @if($approvedrefno->status =="approved")
                <?php 
                    $total += $approvedrefno->product_fee;
                ?>
                @endif
            </tr>

            @empty
            <tr>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
            </tr>
            @endforelse
            <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"><b>TOTAL:</b></td>
                <td align="center">
                <?php 
                if($countapproved != null){
                if($refno->discount == 1){
                    echo $total." - Discounted";
                }else{
                    echo $total; 
                }
                }?>
                </td>
            </tr>
        </table>
        <!-- history -->
        <table id="cart-table" class="historyTable" align="center"  hidden>
            <p align="center" style="margin-top:2px; "class="history-text" hidden><b>HISTORY</b></p>
            <tr>
                <th  class="text-light" style="padding: 5px;">Products</th>
                <th  class="text-light" style="padding: 5px;">Option</th>
                <th class="text-light" style="padding: 5px;">Price</th>
                <th class="text-light" style="padding: 5px;">Quantity</th>
                <th class="text-light" style="padding: 5px;">Paid Fee</th>
                <th class="text-light" style="padding: 5px;">Ref No.</th>
            </tr>
            @forelse($history as $history)
            <tr>
                <td align="center">{{$history->reserved_qty}} {{$history->kg}}kg of {{$history->products}}</td>
                <td align="center">{{$history->buy_option}} at {{$history->history_date}} {{$history->time}}</td>
                <td align="center">{{$history->price}}</td>
                <td align="center">{{$history->reserved_qty}}</td>
                <td align="center">{{$history->product_fee}}</td>
                <td align="center">{{$history->refno}}</td>
            </tr>
            @empty
            <tr>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
                <td align="center">N/A</td>
            </tr>
            @endforelse
        </table>

        @if($countpending != null)
            @if($data->refno == 0)
            <form action="{{url('/refno')}}" method="post" class="refForm">
                @csrf
                    <div class="row">
                    @if($data->buy_option != null)
                        <div class="col-lg-12 col-sm-12 m-1" align="center">
                           <label >Please wait for your request to be approved <label class="text-danger">*</label></label>
                        </div>
                    @endif
                        <div class="col-lg-12 col-sm-12 m-1" align="center" >
                            <select name="buy_option" style="border: 1px solid black; width: 400px;" id="option_type" class="form-design" style="width:350px; border: 1px solid grey; color:black;" required>
                                <option value="" class="text-center" selected disabled>Please select how will you take it...</option>
                                <option value="Walk in" class="text-center">Walk in</option>
                                <option value="Deliver" class="text-center">Deliver</option>
                            </select>
                        </div>

                        <div class="col-lg-12" id="address" hidden>
                            <div class="row gx-3">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <select  class="form-control" name="province" id="update_province">
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <select  class="form-control" name="city" id="update_city">
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <select  class="form-control" name="barangay" id="update_barangay">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div id="filterDate2">    
                                <div class="input-group date" data-date-format="MM/DD/YYYY">
                                    <input style="border:1px solid black;" class="form-design"  name="date" id="date" type="text" class="form-control" placeholder="MM/DD/YYYY" required readonly hidden>
                                        <div class="input-group-addon" >
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                </div>
                            </div>   
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <input style="border:1px solid black;" class="form-design"  type="time" id="time" name="time" required hidden>
                        </div>

                    <div class=" col-lg-12 m-1 text-center">
                        <fieldset>
                            <button name="submit" class="btn btn-success" type="submit"  >RESERVE NOW</button>
                        </fieldset>
                    </div>
                </div>
            </form>
            @endif
        @endif
        @if(count($dd)>0)
        <form action="{{url('/set_ref')}}" method="post" enctype="multipart/form-data" class="refForm2">
        <!-- <form action="" class="refForm2" id="formRef"> -->
            @csrf
            <div class="col-lg-12 col-sm-12 m-2" align="center">
                <label>Note: Reservations are only approved after payment</label>

                @if($refno != null)
                    @php
                        $refno_value = $refno->refno;
                    @endphp
                @else
                    @php
                        $refno_value = '';
                    @endphp
                @endif

                    <fieldset>
                        <label>Enter Ref No. after payment</label>
                        <input 
                        style="margin-top:2px;"
                        name="refno"
                        min="0"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        type = "number"
                        maxlength = "13"
                        value="{{$refno_value}}"
                        placeholder="Enter Ref No. here" required/>
                    </fieldset>

                    <label style="color:black;">Upload QR Image
						<input style="color: white; margin:1%;" type="file" name="image" required>
					</label>

                <div class=" col-lg-12 m-1">
                        <button type="submit" style="background-color:#ee877d;" id="btnPaid"  class="btn btn-m m-1" >SUBMIT</button>
                </div>                
            </div>
        </form>
                  
        @endif
    </div>
    <!-- qr -->
    <div id="top" class="col-lg-5 col-sm-5 m-1 text-center" >
        <p>Scan the QR Code below to pay online or use the number provided</p>

        <!-- if not approved yet do not display-->

        @if(count($dd)>0)
            @foreach($dd as $dds)
            @endforeach 
            @if($dds->status!="pending")
                @if($admin->qr != null)
                <img style="height:450px; width:450px;"src="qr_imgs/{{$admin->qr}}">
                <br>
                <label>Phone Number: {{$admin->phone}}</label>
                @else
                <img src="qr_imgs/qr_sample.jpg">
                @endif
            @endif
        @endif

    </div>
</div>

     <!-- jQuery -->
     <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

<!-- Bootstrap -->
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>


</script>
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

<script src="{{ asset('js/showcart.js') }}" defer></script>

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
     $(document).ready(function(){

        $('.refForm2').hide();

    $('#history_type').change(function(){
        if($('#history_type').val() =='Approved'){
            $('.approvedTable').attr('hidden', false);
            $('.approved-text').attr('hidden', false);
            $('.historyTable').attr('hidden', true);
            $('.history-text').attr('hidden', true);
            $('.pending-text').hide();
            $('.pendingTable').hide();
            $('.pendingForm').hide();
            $('.refForm').hide();
            $('.refForm2').show();
            $('.formBtn').hide();
            $('.submit-btn').hide();
            $('#manage').hide();
        }else if($('#history_type').val() =='History'){
            $('.approvedTable').attr('hidden', true);
            $('.approved-text').attr('hidden', true);
            $('.historyTable').attr('hidden', false);
            $('.history-text').attr('hidden', false);
            $('.pending-text').hide();
            $('.pendingTable').hide();
            $('.pendingForm').hide();
            $('.refForm').hide();
            $('.refForm2').hide();
            $('.formBtn').hide();
            $('.submit-btn').hide();
            $('#manage').hide();

        }else{
            $('.approvedTable').attr('hidden', true);
            $('.approved-text').attr('hidden', true);
            $('.historyTable').attr('hidden', true);
            $('.history-text').attr('hidden', true);
            $('.pending-text').show();
            $('.pendingTable').show();
            $('.pendingForm').show();
            $('.refForm').show();
            $('.refForm2').hide();
            $('.formBtn').show();
            $('.submit-btn').show();
            $('#manage').show();

        }
    })
});
</script>


<script>
    document.getElementById("manage").addEventListener("click", function(){
        var box = document.getElementById('manageRes');
        if(box.style.display == 'none'){
            $("#manage").val('CANCEL');
            $('.check-cls').attr('hidden', false);
            $('.qtyLbl').attr('hidden', true);
            box.style.display = 'block';
        }else{
            $("#manage").val('MANAGE');
            $('.qtyLbl').attr('hidden', false);
            $('.check-cls').attr('hidden', true);
            box.style.display = 'none';
        }

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

</body>
</html>
