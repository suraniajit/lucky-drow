$('#role_submit').click(function(){
    $.ajax({
        type: 'post',
        url: "{{ url('') }}" +
            '/api/role/store',
        data: {},
        headers: {
            'Authorization': 'Bearer ' + customerToken,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
            clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
        },
        beforeSend: function() {},
        success: function(data) {
            if (data.status == 'Success') {
            
            }
        },
        error: function(data) {
            
        },
    });

    $('#AddRoleModal').modal('toggle');
});