function openWithdrawalModel(event){
    var user_id = $(event).attr('data-id');
    var user_name = $(event).attr('data-name');
    $('#withdrawal_person').val(user_name);
    $('#withdrawal_person_id').val(user_id);
    $('#withdrawal_request').show();
    $('#request_withdrawal_otp_varify').hide();
    $('#withdrawal_otp_form_group').hide();
}

$('#withdrawal_request').click(function(){
    var user_id = $('#withdrawal_person_id').val();
    var withdrawal_amount = $('#withdrawal_amount').val();
    var token = window.localStorage.getItem('token');
    $.ajax({
        type: 'post',
        url: withdrawal_request_url,
        data:{
            user_id : user_id,
            withdrawal_amount:withdrawal_amount
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
                $('#withdrawal_transaction_no').val(data.data.transaction);
                $('#withdrawal_request').hide();
                $('#request_withdrawal_otp_varify').show();
                $('#withdrawal_otp_form_group').show();
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

$('#request_withdrawal_otp_varify').click(function(){
    var transaction_no = $('#withdrawal_transaction_no').val();
    var deposit_otp = $('#withdrawal_otp').val(); 
    var token = window.localStorage.getItem('token');
    $.ajax({
        type: 'post',
        url: withdrawal_request_otp_varify_url,
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
            $('#withdrawal_transaction_no').val('');
            $('#withdrawal_amount').val('');
            $('#withdrawal_otp').val('');
            $('#withdrawal_request').show();
            $('#request_withdrawal_otp_varify').hide();
            $('#withdrawal_otp_form_group').hide();
            $('#balance_withdrawal_modal').modal('toggle');
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
