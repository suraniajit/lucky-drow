@extends('themes::layouts.backend.master')
@section('title')    
    {!! __('user::user/labels.user-page-title') !!}
@endsection
@section('page-title')    
{!! __('user::user/labels.user-page-title') !!}
@endsection
@push('css-stack')
@endpush
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-11">   
                        {!! __('user::user/labels.user-page-title') !!}
                    </div>
                    <div class="col-sm-1">
                        @can('admin.user.create')
                            <button type="button" class="btn btn-info btn-lg " id="create_from_button" data-toggle="modal" data-target="#add_user_modal">+</button>  
                        @endcan
                    </div>
                </div>
            </div>  
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('user::user/labels.gird-name') }}</th>
                        <th scope="col">{{ __('user::user/labels.gird-email') }}</th>
                         <th scope="col">{{ __('core::core/labels.gird-status') }}</th>
                        <th scope="col">{{ __('core::core/labels.gird-action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="grid-data">
                        <tr>
                            <td align="center" colspan="4">No Data Found</th>
                        </tr>
                    </tbody>
                </table>
                <!-- table end -->
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="paginate">
                </div>
            </div>
        </div>
    </div>
    <template id="user-grid-template">
        <tr>
            <th class="id"></th>
            <td class="name"></td>
            <td class="email"></td>
            <td class="status"></td>
            <td class="action"></td>
        </tr>            
    </template>

    @can('admin.user.create')
        <div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{!! __('user::user/labels.user-form-add') !!}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="user_form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('user::user/labels.user-form-name') !!}</label>
                                    <input type="text" name="user_name" id="input_name" class="form-control" placeholder="{!! __('user::user/labels.user-form-placeolder-name') !!}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail">{!! __('user::user/labels.user-form-email') !!}</label>
                                    <input type="email" name="user_email" class="form-control " placeholder="{!! __('user::user/labels.user-form-placeolder-email') !!}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputPassword">{!! __('user::user/labels.user-form-password') !!}</label>
                                    <input type="password" id="inputPassword" name="user_password" class="form-control " placeholder="{!! __('user::user/labels.user-form-placeolder-password') !!}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputRole">{!! __('user::user/labels.user-form-role') !!}</label>
                                    <select class="form-control" id="user_roles" name="user_role">
                                        <option></option>
                                    </select>
                                </div>
                                
                                <div class="custom-control custom-switch ">
                                    <input type="checkbox" checked class="custom-control-input show_status" id="add_custom_switch_status" name="user_status" value="1" >
                                    <label class="custom-control-label" for="add_custom_switch_status">{{ __('core::core/labels.gird-status') }}</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! __('core::core/labels.core-form-button-close') !!}</button>
                        <button type="button" class="btn btn-primary" id="user_submit">{!! __('core::core/labels.core-form-button-save') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('admin.show.edit')
        <div class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_show_modal_long_title">{!! __('user::user/labels.user-form-edit') !!}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="user_edit_form">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">{!! __('role::role/labels.role-form-name') !!}</label>
                                    <input type="hidden" value="" name="id"  id="data-id">
                                    <input type="text" name="user_name" class="form-control" id="user_name" placeholder="Please Enter User Name">
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="input_name">{!! __('user::user/labels.user-form-email') !!}</label>
                                    <input type="text" name="user_email" id="user_email" class="form-control" placeholder="{!! __('user::user/labels.user-form-placeolder-email') !!}">
                                </div>
                               
                                <div class="form-group col-md-12">
                                    <label for="inputPassword">{!! __('user::user/labels.user-form-password') !!}</label>
                                    <input type="password" id="inputPassword" name="user_password" class="form-control " placeholder="{!! __('user::user/labels.user-form-placeolder-password') !!}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputRole">{!! __('user::user/labels.user-form-role') !!}</label>
                                    <select class="form-control" id="edit_user_roles" name="user_role">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input user_status" name="status" value="1" id="customSwitch_status">
                                    <label class="custom-control-label" for="customSwitch_status">{{ __('core::core/labels.gird-status') }}</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! __('core::core/labels.core-form-button-close') !!}</button>
                        <button type="button" class="btn btn-primary" id="user_update">{!! __('core::core/labels.core-form-button-save') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    
@endsection
@push('js-stack')
    <script>
        $( document ).ready(function() {
            loadPageGrid();
        });
        $('#create_from_button').click(function(){
            var token = window.localStorage.getItem('token');     
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +'/api/role/',
                data:[],
                headers: {
                    'Authorization': 'Bearer ' ,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: " ",
                    clientsecret: " ",
                    'APIAuthKey':token,
                },
                beforeSend: function() {},
                success: function(data) {
                    if(data.data.length>0){
                        $("#user_roles").html('');
                        var ophtml='';
                        for (i = 0; i < data.data.length; i++) {
                            if(data.data[i].name != '{{config('core.super-admin')}}')       
                            ophtml = ophtml +'<option value="'+data.data[i].name+'">'+data.data[i].name+'</option>';
                        }
                        $("#user_roles").html(ophtml);
                    }
                }
            });
        });
        $('#user_submit').click(function(){
            var token = window.localStorage.getItem('token');
                
            $.ajax({
                type: 'post',
                url: "{{ url('') }}" +'/api/user/save',
                data:$('#user_form').serialize(),
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
                        Swal.fire({        
                            type: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        loadPageGrid();
                        $('#user_form').trigger("reset");
                        
                    }else{

                    }
                },
                error: function(data) {
                    
                },
            });
            $('#add_user_modal').modal('toggle');
        });
        function updateStatus(e){
            url = "{{ url('') }}" +'/api/user/update_status';
            var token = window.localStorage.getItem('token'); 
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    id:$(e).attr('data-id'),
                    status:($(e).prop('checked') == true)?1:2
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
                        Swal.fire({        
                            type: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
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
            loadPageGrid();
        }
        function getEditShow(e){
            id = $(e).attr('data-id');
            url = "{{ url('') }}" +'/api/user/edit/'+id;
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
                        $('.user_status').prop('checked', false);
                        $('#data-id').val(data.data['user'].id);
                        $('#user_name').val(data.data['user'].name);
                        $('#user_email').val(data.data['user'].email);
                        var role_option ='';
                        console.log(data.data['roles'].length);
                        for(var i = 0; i<data.data['roles'].length;i++)
                        {
                            role_option = role_option+'<option value="'+data.data['roles'][i]+'">'+data.data['roles'][i]+'</option>';
                        }
                        $('#edit_user_roles').html(role_option);
                        $(".user_status").prop('checked', false);
                        if(data.data.status==1){
                            $('#customSwitch_status').prop('checked', true);
                        }else{
                            $('#customSwitch_status').prop('checked', false);
                        }
                        $('#edit_user_modal').modal('toggle');
                       
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
        // above done
        function loadPageGrid(e){
            url = $(e).attr('data-page-url');
            url = (url)?url:"{{ url('') }}" +'/api/user/';
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
                            $(".grid-data").html('');
                            const templ = document.getElementById("user-grid-template");
                            for (i = 0; i < data.data.length; i++) {
                                var url = '{{url("/backend/role/permission-manage")}}/'+data.data[i].name;
                                const clone = templ.content.cloneNode(true);
                                clone.querySelector(".id").innerHTML =i+1;
                                clone.querySelector(".name").innerHTML =data.data[i].name;
                                clone.querySelector(".email").innerHTML =data.data[i].email;
                                clone.querySelector(".status").innerHTML =data.data[i].status;
                                var action_str ='<div class="row">';
                                @can('admin.user.edit')
                                    var checkedstring = (data.data[i].status_id == 1)?'checked':'';
                                    var status_button ='<div class="custom-control custom-switch">'+
                                                            '<input type="checkbox" data-id="'+data.data[i].id+'" '+ checkedstring +' onChange="updateStatus(this)" class="custom-control-input show_grid_status" id="customSwitch'+data.data[i].id+'">'+
                                                            '<label class="custom-control-label" for="customSwitch'+data.data[i].id+'"></label>'+
                                                        '</div>';
                                    action_str = action_str +''+status_button ;
                                    edit_button = '';
                                    var edit_button =   '<button type="button" onClick="getEditShow(this)" data-id="'+data.data[i].id+'" class="btn btn-info btn-sm" >'+
                                                            '<i class="fa fa-pencil" aria-hidden="true"></i>'+
                                                        '</button>';
                                    action_str = action_str +''+edit_button ;
                                @endcan
                                @can('admin.user.delete')
                                    var delete_str = '<button type="button" onclick="deleteUser(this)" class="btn btn-danger btn-sm"  data-id="'+data.data[i].id+'">'+
                                                        '<i class="fa fa-trash" aria-hidden="true"></i>'+
                                                    '</button>';
                                    action_str = action_str+''+ delete_str; 
                                @endcan
                                action_str = action_str+'</div>'; 
                                // if(){}
                                clone.querySelector(".action").innerHTML = action_str;
                                $(".grid-data").append(clone);
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
        $('#user_update').click(function(){
            var token = window.localStorage.getItem('token');     
            $.ajax({
                type: 'post',
                url: "{{ url('') }}" +'/api/user/update',
                data:$('#user_edit_form').serialize(),
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
                        Swal.fire({        
                            type: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#user_form').trigger("reset");
                        loadPageGrid();
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
            $('#edit_user_modal').modal('toggle');
        });
        

        
        function deleteUser(e){
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {        
                    var id =$(e).attr('data-id');
                    url = "{{ url('') }}" +'/api/user/delete/'+id;
                    var token = window.localStorage.getItem('token'); 
                    $.ajax({
                        type: 'post',
                        url: url,
                        data:{},
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
                                Swal.fire({        
                                    type: 'success',
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                loadPageGrid();
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
            });  
        }
    </script>   
@endpush