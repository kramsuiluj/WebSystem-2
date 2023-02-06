$(document).ready(function(){

    // alert("hello");

    onupdate_load_address();

    function onupdate_load_address(e) {

        const options = {
        	xsrfCookieName: 'XSRF-TOKEN',
        	xsrfHeaderName: 'X-XSRF-TOKEN',
        };

        axios.post('/onupdate_load_address', options)
        .then(function(response){

            if (response.data.statusCode == 200) {
                var province = response.data.province;
                var city = response.data.city;
                var brgy = response.data.brgy;
                var bodyData = '';
                var bodyData1 = '';
                var bodyData2 = '';
                //province
                bodyData += ("<option value=0>-</option>");
                $.each(province, function(index, row) {
                    bodyData += ("<option value=" + row.provCode + ">" + row.provDesc + "</option>");
                })
                $("#update_province").empty();
                $("#update_province").append(bodyData);
                //city
                bodyData1 += ("<option value=0>-</option>");
                $.each(city, function(index, row) {
                    bodyData1 += ("<option value=" + row.citymunCode + ">" + row.citymunDesc + "</option>");
                })
                $("#update_city").empty();
                $("#update_city").append(bodyData1);
                //brgy
                bodyData2 += ("<option value=0>-</option>");
                $.each(brgy, function(index, row) {
                    bodyData2 += ("<option value=" + row.brgyCode + ">" + row.brgyDesc + "</option>");
                })
                $("#update_barangay").empty();
                $("#update_barangay").append(bodyData2);


            }
        })
        .catch(function(error){
            alert(error);
        })
        .then(function(response){})
    }

    $(document).on('change', '#update_city ', function(e) {
        var citycode = $(this).val();

        const options = {
        	xsrfCookieName: 'XSRF-TOKEN',
        	xsrfHeaderName: 'X-XSRF-TOKEN',
        };

        axios.post('/onselect_city_load_brgy', null, {
            params: {
                id: citycode
            }
        }, options)
        .then(function(response){
            
            var count = response.data.rowcount;
            var resultData = response.data.data;
            var errcode = response.data.statusCode;
            if (errcode == 200) {
                // loadbrgy();
                var bodyData = '';
                bodyData += ("<option value>-</option>");
                $.each(resultData, function(index, row) {
                    bodyData += ("<option value=" + row.brgyCode + ">" + row.brgyDesc + "</option>");
                })
                $("#update_barangay").empty();
                $("#update_barangay").append(bodyData);
            }
        })
        .catch(function(error){
            alert(error);
        })
        .then(function(response){})

    });

    function loadmun(){

        const options = {
            xsrfCookieName: 'XSRF-TOKEN',
            xsrfHeaderName: 'X-XSRF-TOKEN',
        };

        axios.post('/onupdate_load_address', options)
        .then(function(response){
        var stat = response.data.statusCode;
        var province = response.data.province;
        var city = response.data.city;
        var brgy = response.data.brgy;
        var emp;


        $(city).each(function(index, row) {
            emp += "<option>" + row.citymunDesc + "</option>"
        })
        $("#tixto").append(emp);

        })
        .catch(function(error){
            alert(error);
        })
        .then(function(){});
    }

    // function loadbrgy(){
    //     var id = muncode;

    //     // FOR SECURITY PURPOSE 
    //     const options = {
    //         xsrfCookieName: 'XSRF-TOKEN',
    //         xsrfHeaderName: 'X-XSRF-TOKEN',
    //     };

    //     axios.get('/loadbrgy',{
    //         params: {
    //             id: id
    //           }
    //       },options)
    //     .then(function(response){
    //     var stat = response.data.status;
    //     var brgy = response.data.data;
    //     var idnya = response.data.id;
    //     var emp;

    //     $(brgy).each(function(index, row) {
    //         emp += "<option>" + row.brgyDesc + "</option>"
    //     })
    //     $("#tixto").append(emp);

    //     })
    //     .catch(function(error){
    //         alert(error);
    //     })
    //     .then(function(){});
    // }
})