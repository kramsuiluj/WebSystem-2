$(document).ready(function() {
    //var declared on top are globals
    actionRequest='';
    request_id=0;
    var kilosDefault=0;

    $(document).on('click', '#updateProducts', function(e) {
        actionRequest=2; //update
        $('#descTittle').text("Updating Product");
        request_id=$(this).val();
 
        e.preventDefault();
         axios.get('/get_product',{
             params: {
                request_id: request_id
               }
           })    
         .then(function (response) { 
             var resultData=response.data.data;
            $(resultData).each(function(index, item) {
                $("#product").val(item.title);
                $("#description").val(item.description);
                $("#price").val(item.price);
                $("#kilos").val(item.kg);
                $("#store").val(item.store_quantity);
                $("#warehouse").val(item.warehouse_quantity);
                kilosDefault=item.kg;
            })
         
         })
         .catch(function (error) {})
         .then(function () {}); 
       
    });

    $(document).on('click', '#btnCreate', function(e) {
        actionRequest=1; //update
        $('#descTittle').text("Create Product");
    });
    

    $(document).on('click', '#addProduct', function(e) {

        actionRequest=actionRequest; 
        request_id=request_id;

        var datas = $('#frmAddProduct');
        var formData = new FormData($(datas)[0]);
            formData.append('actionRequest', actionRequest);
            formData.append('request_id', request_id);
            formData.append('kilosDefault', kilosDefault);

            axios.post('/uploadproduct',formData)
            .then(function (response) { 
                var msg=response.data.msg;
                if (response.data.status == 0) {
                    $.each(response.data.error, function(prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    if(response.data.status==200){
                        //success operation
                        message_success(msg);
                        location.reload();
                    }else{
                        //fail operation
                        message_error(msg);
                    }

                }    
            })
            .catch(function (error) {
            // handle error
            
            })
            .then(function () {
            // always executed
            });


    });

    function message_success(msg){
        const Toast = Swal.mixin({
            toast: true,
            position: 'center-center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          
          Toast.fire({
            icon: 'success',
            title: msg
          })
        
        
    }

    function message_error(msg){
        const Toast = Swal.mixin({
            toast: true,
            position: 'center-center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          
          Toast.fire({
            icon: 'success',
            title: msg
          })
        
        
    }
   
});
