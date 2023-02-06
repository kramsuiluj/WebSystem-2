
<!-- Modal -->                   
<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModallbl" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-white">

      <div class="modal-header " style="background-color:#F4A460">
        <h5 class="modal-title fst-italic text-white" id="staticBackdropLabel">User Management</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </button>
      </div>

<div class="modal-body">
        <div class="col-lg-12">
            <div class="contact-form">
<form  method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="row">

                <div class="row ">

                    <div class="form-inline">
                        <label>Recipient</label>
                        <input class="form-group mb-2" type="text" class="recipient" name="recipient" placeholder="Recipient's Name" required >
                    </div>

                    <div class="form-inline">
                        <label>Product</label>
                        <input class="form-group mb-2" type="text" name="prod_name" placeholder="Product Name" required>
                    </div>
                      
                    <div class="form-inline">
                        <label>Quantity</label>
                        <input class="form-group mb-2" type="number" name="prod_qty" placeholder="Enter Quantity" min="1" required>
                    </div>
          
                    <div class="form-inline">
                        <label>Paid Fee</label>
                        <input class="form-group mb-2" type="number" name="paid_fee" placeholder="Amount Paid" min="1" required>
                    </div>
          
                    <div class="form-inline">
                        <label>Total Fee</label>
                        <input class="form-group mb-2" type="number" name="total_fee" placeholder="Total Amount" min="1" required>
                    </div>
                      
                    <div class="form-inline">
                        <label>Date: <input class="form-group mb-2" type="text" id="date" name="date" placeholder="MM/DD/YYYY" value="" readonly></label>
                    </div>
          
                    <div class="form-inline">
                        <label>Insert Image</label>
                        <input class="form-group mb-2" type="file" name="image" required>
                    </div>

                    <div class="form-inline">
                        <label>Receipt for: </label>
                        <p><input type="checkbox" class="checkfor" name="checkfor" value="Customer" /> Customer
                        <input type="checkbox" class="checkfor" name="checkfor" value="Supplier"/> Supplier</p>
                    </div>

                </div>

                    <div class="text-center m-1">      
                        <input style="float:right;" formaction="{{url('/uploadreceipt')}}" type="submit" value="SAVE RECEIPT" class="btn btn-success btn-m">
                    </div>

            </div>
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

