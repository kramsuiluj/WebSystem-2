$(document).ready(function() {
    actionRequest='';
    request_id=0;

    $(document).on('click', '#btnCreate', function(e) {
        actionRequest=1; //add
        $('#descTittle').text("Create Receipt");
    });
    
    $(document).on('click', '#addReceipt', function(e) {
       
        actionRequest=actionRequest; 
        request_id=request_id;

        var datas = $('#frmAddReceipt');
        
        var formData = new FormData($(datas)[0]);
            formData.append('actionRequest', actionRequest);
            formData.append('request_id', request_id);

            axios.post('/uploadreceipt',formData)
            .then(function (response) { 
                var msg=response.data.msg;
                if (response.data.status == 0) {
                    $.each(response.data.error, function(prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    if(response.data.status==200){
                        message_success(msg);
                        location.reload();
                        // $('#frmAddReceipt')[0].reset();
                    }else{
                        message_error(msg);
                        // $('#addReceipt')[0].reset();
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
