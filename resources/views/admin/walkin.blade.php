<!DOCTYPE html>
<html lang="en">
  <head>

    @include("admin.admincss")

  </head>
  <body>
  <div class="container-scroller">
    <div class="row">
      <div class="col-lg-3">
      @include("admin.navbar")
      </div>
    </div>  

  <div class="content-wrapper">
  @if(Auth::user()->access_level == 2)
      <div class="row">
      <h1 class=" mt-1 mb-2 h4 mb-0 text-gray-800">Store Walk In Customer</h1>
      <br>    
      <br>
    </div>


  <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
              <div class="row ">
              @foreach($data as $store_data)
                    @include('admin.storeModal')
                        <div class="col-sm-3 text-center" style="margin:1px;">

                            <div>
                            <img height="200" width="200" src="productimage/{{$store_data->image}}">
                            </div>

                            <div class="mt-1">
                                <button class="btn btn-success" data-toggle="modal" data-target="#storeModal{{$store_data->id}}" ><i class='fa fa-pencil-alt'></i></button>
                            </div>
                
                        </div>

                @endforeach
              </div>
          </div>
        </div>
      </div>
  </div>
@endif
<!-- ware div -->
  <div class="row">
      <h1 class=" mt-1 mb-2 h4 mb-0 text-gray-800">Warehouse Walk In Customer</h1>
      <br>    
      <br>
    </div>

  <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
              <div class="row ">
                @foreach($data as $ware_data)
                    @include('admin.wareModal')
                        <div class="col-sm-3 text-center" style="margin:1px;">

                            <div>
                            <img height="200" width="200" src="productimage/{{$ware_data->image}}">
                            </div>

                            <div class="mt-1">
                                <button class="btn btn-success" data-toggle="modal" data-target="#warehouseModal{{$ware_data->id}}" ><i class='fa fa-pencil-alt'></i></button>
                            </div>
                
                        </div>

                @endforeach
              </div>
          </div>
        </div>
      </div>
  </div>
<!-- ware div end -->
  </div>
</div>
    @include("admin.adminscript")

  </body>
</html>