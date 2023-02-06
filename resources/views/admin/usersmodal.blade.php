
<!-- Modal -->                   
<div class="modal fade" id="usersModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="usersModallbl" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-white">
      <div class="modal-header" style="background:#fd7e14;">
      <h5 class="modal-title fst-italic text-white" id="staticBackdropLabel">User Management</h5>
      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="col-lg-12">
            <div class="contact-form">
              <form id="contact" action="{{url('/updateAccess',$data->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class='text-dark mt-3 mb-2'>User: {{$data->email}}</h3>
                        </div>

                        <div class="col-lg-12">
                             <div align=center>
                             @if($data->profile_photo_path == null)
                              <img style="margin:5px; height:200px; width:200px;" src="assets/images/anonymous.jpg" >
                              @else
                              <img style="margin:5px; height:200px; border:1px solid black; width:200px;" src="storage/     {{$data->profile_photo_path}}">
                              @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                          <div align=center>
                            <input style="margin-top:1px; width:250px;" value="{{$data->name}}" readonly><br>
                            <input style="margin-top:1px; width:250px;" value="{{$data->email}}" readonly><br>
                            <input style="margin-top:1px; width:250px;" value="{{$data->phone}}" readonly>
                          </div>
                        </div>

                        <div class=" col-lg-12 mb-2 mt-5 text-center">
                              <fieldset>
                                @if($data->access_level >= 1)
                                <a href="{{url('/removeAccess',$data->id)}}"  type="submit"  class="btn btn-success mb-4">SET AS CUSTOMER</a>
                                @else
                                <button name="submit" type="submit" id="form-submit" class="btn btn-success mb-4" >SET AS ADMIN</button>
                                @endif
                                <a  href="{{url('/deleteuser',$data->id)}}"  type="submit" class="btn btn-danger mb-4" >REMOVE USER</a>
                              </fieldset>
                        </div>
                    </div>
              </form>
            </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

