<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
    @include("admin.admincss")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <style>
      @media (max-width:645px) {
        .row{
          margin-top:10%;
        }
      }
    </style>
  </head>
  <body>
  <div class="container-scroller">@include("admin.navbar")
    <div class="row" style="margin-top:6%; ">
      <div class="col-lg-7" style="background-color:white; margin:2px;" align="center">
          <div class="contact-form">
              <form id="contact" action="{{url('/updateAccess',$data->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <h5 class='text-dark mt-3 mb-2'>User account {{$data->email}}</h5>
                  </div>

                  <div class="col-lg-12">
                      <div align=center>
                        @if($data->profile_photo_path == null)
                        <img style="margin:5px; height:200px; width:200px;" src="assets/images/anonymous.jpg" >
                        @else
                        <img style="margin:5px; height:200px; border:1px solid black; width:200px;" src="storage/{{$data->profile_photo_path}}">
                        @endif
                      </div>
                  </div>

                  <div class="col-lg-12 m-1">
                      <select name="usertype" id="user_type" class="form-design" style="height:40px; width:350px; border: 1px solid black; color:white; font-weight:bold; background-color:grey;" required>
                        @if($data->usertype == 0)
                        <option value="0" class="text-center" selected >Set As Customer</option>
                        <option value="1" class="text-center">Set As Admin</option>
                        @else
                        <option value="1" class="text-center" selected>Set As Admin</option>
                        <option value="0" class="text-center" disabled>Set As Customer</option>
                        @endif
                      </select>
                  </div>

                  <div class="col-lg-6 col-sm-12 mt-2">
                    <fieldset>
                      <input style="color:black; margin-top:1px; width:250px;" class="form-design" name="name" type="text" id="name" value="{{$data->name}}" readonly>
                    </fieldset>
                  </div>

                  <div class="col-lg-6 col-sm-12 mt-2">
                    <fieldset>
                      <input style="color:black; margin-top:1px; width:250px;" class="form-design" name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" value="{{$data->email}}" readonly>
                    </fieldset>
                  </div>

              @if($data->access_level == null)
              @if($data->usertype == 1)
              <div class="col-lg-12 text-center m-1" id="checkboxDiv">
              @else
              <div class="col-lg-12 text-center m-1" id="checkboxDiv" hidden>
              @endif
                <h4 class='text-dark mt-5'><strong>~ Access Level ~</strong></h4>
              <div class="col-lg-12 text-center m-1">

                <div class="col-lg-12 text-center m-1" class="no-gutters" style="height:25px; width: auto;">
                    <p class='text-dark mr-2'><input class="checkoption" onclick="checkedOnClick(this);" type="checkbox" name="access" value="1" checked="true"/> Sales Manager</p>
                </div>
                <!-- <div class="col-lg-12 text-center m-1" class="no-gutters" style="height:25px; width: auto;">
                    <p class='text-dark mr-2'><input class="checkoption" onclick="checkedOnClick(this);" type="checkbox" name="access" value="0" checked="true"/> Driver</p>
                </div> -->
                <div class="col-lg-12 text-center m-1" class="no-gutters" style="height:25px; width: auto;">
                    <p class='text-dark mr-2'><input class="checkoption" onclick="checkedOnClick(this);" type="checkbox" name="access" value="2"/> All</p>
                </div>

              </div>
              </div>
            @endif
            @if($data->access_level != null)
              <div class="col-lg-12 text-center m-1" >
                <h4 class='text-dark m-2'><strong>~ Access Given ~</strong></h4>
            @endif
            @if ($data->access_level == 1)
            <div class="col-lg-12 text-center m-1" class="no-gutters" style="height:25px; width: auto;">
                    <p class='text-dark mr-2'><input type="checkbox" name="access" value="1" checked="true" /> Sales Manager</p>
            </div>
            @endif
            @if ($data->access_level == 3)
            <div class="col-lg-12 text-center m-1" class="no-gutters" style="height:25px; width: auto;">
                    <p class='text-dark mr-2'><input type="checkbox" name="access" value="2" checked="true"/> All</p>
            </div>
            </div>
            @endif

                  <div class=" col-lg-12 mb-2 mt-5">
                              <fieldset>
                                @if($data->access_level >= 1)
                                <a href="{{url('/removeAccess',$data->id)}}"  type="submit"  class="btn btn-success" disabled>REMOVE ACCESS</a>
                                @else
                                <button name="submit" type="submit" id="form-submit" class="submit-btn btn btn-success" disabled>UPDATE</button>
                                @endif
                                <a href="{{url('/deleteuser',$data->id)}}"  type="submit" class="btn btn-danger">REMOVE USER</a>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
    </div>
    </div>
    
    <script type="text/javascript">
   function checkedOnClick(el){

      // Select all checkboxes by class
      var checkboxesList = document.getElementsByClassName("checkoption");
      for (var i = 0; i < checkboxesList.length; i++) {
         checkboxesList.item(i).checked = false; // Uncheck all checkboxes
      }

      el.checked = true; // Checked clicked checkbox
   }
   </script>
   
   <script>
    $(document).ready(function(){
    $('#user_type').change(function(){
        if($('#user_type').val() =='1'){
            $('#checkboxDiv').attr('hidden', false);
            $('.submit-btn').attr('disabled', false);
        }else{
            $('#checkboxDiv').attr('hidden', true);
            $('.submit-btn').attr('disabled', true);
        }
      })
    });
    </script>  
  	@include("admin.adminscript")         
  </body>
</html>