function loadPageGrid(e){
    url = $(e).attr('data-page-url');
    url = (url)?url:grid_url;
    var token = window.localStorage.getItem('token');             
    $.ajax({
        type: 'get',
        url: url,
        data: {},
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
                if(data.data.length>0){
                    grid_element.html('');
                    const templ = document.getElementById("grid-template");
                    for (i = 0; i < data.data.length; i++) {
                        
                        const clone = templ.content.cloneNode(true);
                        for (var coloum_name in display_column) {
                            if(display_column[coloum_name] == 'text'){
                                clone.querySelector("."+coloum_name).innerHTML = data.data[i][coloum_name];
                            }
                        }
                        var action_str ='<div class="row">';
                        if((is_edit_action_available != undefined ) && is_edit_action_available){
                            var checkedstring = (data.data[i].status_id == 1)?'checked':'';
                            var status_button ='<div class="custom-control custom-switch">'+
                                                    '<input type="checkbox" data-id="'+data.data[i].id+'" '+ checkedstring +' onChange="updateStatus(this)" class="custom-control-input show_grid_status" id="customSwitch'+data.data[i].id+'">'+
                                                    '<label class="custom-control-label" for="customSwitch'+data.data[i].id+'"></label>'+
                                                '</div>';
                            action_str = action_str +''+status_button ;
                            edit_button = '';
                            var edit_button =   '<button type="button" onClick="getEditData(this)" data-id="'+data.data[i].id+'" class="btn btn-info btn-sm" >'+
                                                    '<i class="fa fa-pencil" aria-hidden="true"></i>'+
                                                '</button>';
                            action_str = action_str +''+edit_button ;
                        }
                        if((is_delete_action_available != undefined ) && is_delete_action_available){
                            var delete_str = '<button type="button" onclick="deleteData(this)" class="btn btn-danger btn-sm"  data-id="'+data.data[i].id+'">'+
                                                '<i class="fa fa-trash" aria-hidden="true"></i>'+
                                            '</button>';
                            action_str = action_str+''+ delete_str; 
                        }
                        action_str = action_str+'</div>'; 
                        clone.querySelector(".action").innerHTML = action_str;
                        grid_element.append(clone);
                    }
                    $('#paginate').html(data.proparty.link);
                }
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
                    text: 'Something went wrong!',
                    showConfirmButton: false,
                    timer: 1500
                 });
        },
    });
}
