<div class="modal fade" id="warehouseModal{{$ware_data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="warehouseModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-md modal-md">
          <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fst-italic text-white" id="descTittle">Sell product from Warehouse</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">                                                  
            <div class="card   mb-3 rounded">
              <div class="card-body"> 
                <div class="container">
                  <div class="row gx-4 gx-lg-5  mb-4"> 

                    <form action="{{url('/sold_from_walkin')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <div class="col-lg-12 col-sm-12 m-2" align="center">
                <h3>{{$ware_data->title}}</h3>
                <?php 
                          $kilo = explode('.',$ware_data->kg);
                          $warehouse = explode('.',$ware_data->warehouse_quantity);
                          echo "<u>Available in warehouse</u>";
                          for($i=0;$i<count($warehouse);$i++) {
                    if($warehouse[$i] != 0){
                    echo '<br/>'.$warehouse[$i].' stacks of '.$kilo[$i].'kg';
                      }
                            }
                            ?>  
                <h5 class='m-2'>~ KILOS ~</h5>
                </div>


        </div>
        <div class="row col-12">
        @php
            $kilos = explode('.',$ware_data->kg);
            $fee = explode('.',$ware_data->price);
            $max = explode('.', $ware_data->warehouse_quantity);
        @endphp
        <div class="row col-lg-12 m-1 " class="no-gutters" >
        @for($i=0; $i < count($kilos);$i++)


          <div class="col-sm-3 ">
            <p class='text-dark mr-1'><input type="checkbox" name="prod_kilos[]" value="{{$kilos[$i]}}" id="checkitem" class="check-cls"/> {{$kilos[$i]}}kg </p>
          </div>

          <div class="col-sm-4 ">
            <p class='text-dark mr-1'>Qty:</p><input style="width:70px; height:25px;" type="number" name="prod_qty[{{$kilos[$i]}}]" min="1" value="1" max="{{$max[$i]}}" class="form-control ml-2">
          </div>

          <div class="col-sm-4">  
            <p class='text-dark mr-1'>Paid Amount:</p><input style="width:70px; height:25px;" type="number" name="paid[{{$kilos[$i]}}]" min="1" value="1" class="form-control ml-2">
          </div>
            
            <input type="hidden" name="product_name[{{$kilos[$i]}}]" value="{{$ware_data->title}}">
            <input type="hidden" name="product_price[{{$kilos[$i]}}]" value="{{$fee[$i]}}">
            <input type="hidden" name="prod_id[{{$kilos[$i]}}]" value="{{$ware_data->id}}">
            <input type="hidden" name="define[{{$kilos[$i]}}]" value="warehouse">
        @endfor 
        </div>

        </div>
        <div class=" col-lg-12 mt-5">
            <button type="submit" class="submit-btn btn-success" style='float:right; border-radius:5px;' >SOLD NOW</button>
        </div>
      </form>
                  
                                                        
                  </div> 
                </div>                                      
              </div>
             </div>
  
            </div>
          </div>
        </div>
    </div>



