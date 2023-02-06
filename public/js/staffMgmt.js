$(document).ready(function() {
    actionRequest='';
    request_id=0;
    // var priceDefault=0;
    // var storeDefault=0;
    // var warehouseDefault=0;

    $(document).on('click', '#updateStaff', function(e) {
        actionRequest=2; //update
        $('#descTittle').text("Updating Staff");
        request_id=$(this).val();
 
        e.preventDefault();
         axios.get('/get_staff',{
             params: {
                request_id: request_id
               }
           })    
         .then(function (response) { 
             var resultData=response.data.data;
            $(resultData).each(function(index, item) {
                $("#name").val(item.name);
                $("#contact").val(item.speciality);

            })
         
         })
         .catch(function (error) {})
         .then(function () {}); 
       
    });

    $(document).on('click', '#btnCreate', function(e) {
        actionRequest=1; //add
        $('#descTittle').text("Create Staff");
    });
    

    $(document).on('click', '#addProduct', function(e) {

        actionRequest=actionRequest; 
        request_id=request_id;

        var datas = $('#frmAddStaff');
        var formData = new FormData($(datas)[0]);
            formData.append('actionRequest', actionRequest);
            formData.append('request_id', request_id);

            axios.post('/uploadstaffs',formData)
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
                        // $('#frmAddProduct')[0].reset();
                    }else{
                        message_error(msg);
                        // $('#addProduct')[0].reset();
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
