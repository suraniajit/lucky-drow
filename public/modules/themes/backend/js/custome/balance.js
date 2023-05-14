function getCurrentBalance() {
  var token = window.localStorage.getItem('token');     
    $.ajax({
        type: 'get',
        url: base_url+'/api/balance/current_balance',
        data:[],
        headers: {
            'Authorization': 'Bearer ' ,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            clientid: " ",
            clientsecret: " ",
            'APIAuthKey':token,
        },
        beforeSend: function() {
            $('.current_balance').html('<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');
        },
        success: function(data) {
            if (data.status == 'Success') {
                $('.current_balance').html('<i class="fa fa-inr" aria-hidden="true"></i>  '+data.data.current_balance);
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Something Went To Wrong',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function(data) {
            Swal.fire({
                    icon: 'error',
                    text: 'Something Went To Wrong',
                    showConfirmButton: false,
                    timer: 1500
                });
        },
    });
  }