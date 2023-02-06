
<!-- Modal -->                   
<div class="modal fade" id="updateModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModal{{$data->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <img src="assets/images/rice.png">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
    <div class="col-lg-12">
        <div class="contact-form">
            <form id="contact" action="{{url('/reservation')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <div class="col-lg-12 col-sm-12 m-2" align="center">
                <h3>{{$data->title}}</h3>
                <img height="200" width="200" src="productimage/{{$data->image}}">
                <h5 class='m-2'>~ KILOS ~</h5>
                </div>


        </div>
        <div class="row col-12">
        @php
    				$kilos = explode('.',$data->kg);
            $fee = explode('.',$data->price);
				@endphp
        @for($i=0; $i < count($kilos);$i++)
        <div class="row sm-6 ml-4 mb-1" class="no-gutters" style="height:25px; width: auto;">
            <p class='text-dark mr-2'><input type="checkbox" name="prod_kilos[]" value="{{$kilos[$i]}}" id="checkitem" class="check-cls"/> {{$kilos[$i]}}kg </p>
            <p class='text-dark'>Qty:</p><input style="width:80px; height:25px;" type="number" name="prod_qty[{{$kilos[$i]}}]" min="1" value="1" class="form-control ml-2">
            <input type="hidden" name="product_name[{{$kilos[$i]}}]" value="{{$data->title}}">
            <input type="hidden" name="product_fee[{{$kilos[$i]}}]" value="{{$fee[$i]}}">
            <input type="hidden" name="prod_id[{{$kilos[$i]}}]" value="{{$data->id}}">
        </div>
        @endfor	
        </div>
        <div class=" col-lg-12 mt-5">
            <button name="submit" type="submit" id="form-submit"  class="submit-btn" >ADD TO CART</button>
        </div>
      </form>
    </div>
    </div>
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
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
