function openDepositModel(event){
    var user_id =$(event).attr('data-id');
    var user_name =$(event).attr('data-name');
    $('#deposit_person').val(user_name);
    $('#deposit_person_id').val(user_id);
    $('#deposit_request').show();
    $('#request_otp_varify').hide();
    $('#otp_form_group').hide();
}

$('#deposit_request').click(function(){
    var user_id = $('#deposit_person_id').val();
    var deposit_amount = $('#deposit_amount').val();
    var token = window.localStorage.getItem('token');
    $.ajax({
        type: 'post',
        url: deposit_request_url,
        data:{
            user_id : user_id,
            deposit_amount:deposit_amount
        },
        headers: {
            'Authorization': 'Bearer ' ,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            clientid: " ",
            clientsecret: " ",
            'APIAuthKey':token,
        },
        beforeSend: function() {},
        success: function(data) {
            if (data.status == 'Success') {
                $('#transaction_no').val(data.data.transaction);
                $('#deposit_request').hide();
                $('#request_otp_varify').show();
                $('#otp_form_group').show();
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Something went wrong!',
                    showConfirmButton: false,
                    timer: 1500
                 });
            }  
        },
        error: function(data) {
            Swal.fire({
                    icon: 'error',
                    text: 'Something went wrong!',
                    showConfirmButton: false,
                    timer: 1500
                 });
        },
    });
});

$('#request_otp_varify').click(function(){
    var transaction_no = $('#transaction_no').val();
    var deposit_otp = $('#deposit_otp').val(); 
    var token = window.localStorage.getItem('token');
    $.ajax({
        type: 'post',
        url: deposit_request_otp_varify_url,
        data:{
            transaction_no : transaction_no,
            deposit_otp:deposit_otp,
        },
        headers: {
            'Authorization': 'Bearer ' ,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            clientid: " ",
            clientsecret: " ",
            'APIAuthKey':token,
        },
        beforeSend: function() {
            $('#transaction_no').val('');
            $('#deposit_amount').val('');
            $('#deposit_otp').val('');
            $('#deposit_request').show();
            $('#request_otp_varify').hide();
            $('#otp_form_group').hide();
            $('#balance_deposit_modal').modal('toggle');
        },
        success: function(data) {
            if (data.status == 'Success') {
                loadPageGrid();
                Swal.fire({        
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
           }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Something went wrong!',
                    showConfirmButton: false,
                    timer: 1500
                 });
            } 
           
        },
        error: function(data) {
            Swal.fire({
                icon: 'error',
                text: 'Something went wrong!',
                showConfirmButton: false,
                timer: 1500
            });
        },
    });
});